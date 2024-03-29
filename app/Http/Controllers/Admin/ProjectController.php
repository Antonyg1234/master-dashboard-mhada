<?php

namespace App\Http\Controllers\Admin;

use App\Board;
use App\Http\Controllers\Controller;
use App\Http\Traits\FileUpload;
use App\Model\DeleteProject;
use App\Project;
use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{

    use FileUpload;

    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commonConfig.list_num_of_records_per_page');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request, DataTables $datatables){

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'name','name' => 'name','title' => 'Project Name'],
            ['data' => 'board_id','name' => 'board_id','title' => 'Board Name'],
            ['data' => 'description','name' => 'description','title' => 'Description'],
            ['data' => 'project_url','name' => 'project_url','title' => 'Project Url'],
            ['data' => 'icon','name' => 'icon','title' => 'Icon'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));


            $projects = Project::with('getBoardName')->get();

            return $datatables->of($projects)
                ->editColumn('rownum', function ($projects) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('name', function ($projects) {
                    return $projects->name;
                })
                ->editColumn('board_id', function ($projects) {
                    return $projects->getBoardName->name;
                })
                ->editColumn('description', function ($projects) {
                    return $projects->description;
                })
                ->editColumn('project_url', function ($projects) {
                    $project_url = $projects->project_url;
                    return '<a target="_blank" href="'.$project_url.'">'.$project_url.'</a>';
                })
                ->editColumn('icon', function ($projects) {
                    $icon_url = $projects->icon;
                    return '<img src="'.$icon_url.'"height="50px" width="50px"/>';

                })
                ->editColumn('actions', function ($projects) {
                    return view('admin.project.action', compact('projects'))->render();
                })

                ->rawColumns(['name','board_id','description','project_url','icon','actions'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());

        return view('admin.project.project-list',compact('html'));


    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
//            "order"=> [2, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $boards = Board::get();
        return view('admin.project.create',compact('boards'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:boards,name',
            'board_id' => 'required',
            'project_url' => 'required',
            'icon'  => 'required|image|mimes:jpg,png,gif,jpeg'

        ]);
        //create the new role
        $project = new Project();
        $project->name = $request->input('name');
        $project->board_id = $request->input('board_id');
        $project->description = $request->input('description');
        $project->project_url = $request->input('project_url');

        if ($request->file('icon')) {
            $image = $request->file('icon');
            $file_name = $image->getClientOriginalName();
            $folder_name = "images";
            $uploadedFilePath =  $this->imageUpload($folder_name,$image,$file_name);
        }
        $project->icon = $uploadedFilePath;
        $project->save();

        return redirect()->route('list-project')
            ->with('success','Project created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
//        dd($id);
        $project = Project::FindOrFail($id)->toArray();
        $boards = Board::get();
        return view('admin.project.show', compact( 'project','boards'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $project = Project::FindOrFail($id)->toArray();
        $boards = Board::get();
        return view('admin.project.edit', compact( 'project','boards'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'board_id' => 'required',
            'project_url' => 'required',
        ]);

        $project = Project::FindOrFail($id);
        if($request->input('name') != $project['name'] ){
            $project->name = $request->input('name');
        }
        if($request->input('board_id') != $project['board_id'] ){
            $project->board_id = $request->input('board_id');
        }
        if($request->input('description') != $project['description'] ){
            $project->description = $request->input('description');
        }
        if($request->input('project_url') != $project['project_url'] ){
            $project->project_url = $request->input('project_url');
        }
        if ($request->file('icon')) {
            $old_icon_link = $request->input('old_icon');
            $image = $request->file('icon');
            $file_name = $image->getClientOriginalName();
            $folder_name = "images";
            $uploadedFilePath =  $this->imageUpload($folder_name,$image,$file_name,$old_icon_link);
        }
        $project->icon = $uploadedFilePath;

        $project->save();

        return redirect()->route('list-project')
            ->with('success','Project updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $projectsDetails = Project::findOrfail($id);
        $folder = 'images';
        $this->deleteOldImage($folder,$projectsDetails->icon);
        $projectsDetails->delete();

        DeleteProject::create([
            'deleted_project_id'=> $id,
            'user_id'   => Auth::id(),
            'name'      => $projectsDetails->name,
            'day'       => date('l'),
            'date'      => date('Y-m-d'),
            'time'      => date("h:i:s"),
            'reason'    => $request->input('delete_message'),
        ]);

        return redirect()->route('list-project')->with(['success'=> 'Project deleted successfully']);
    }

    public function loadDeleteProjectUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.project.deleteReason', compact('id'))->render();
    }



}
