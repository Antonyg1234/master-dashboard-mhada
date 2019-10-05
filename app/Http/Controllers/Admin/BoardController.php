<?php

namespace App\Http\Controllers\Admin;

use App\Board;
use App\Http\Controllers\Controller;
use App\Model\DeleteBoard;
use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{

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
            ['data' => 'name','name' => 'name','title' => 'Board Name'],
            ['data' => 'description','name' => 'description','title' => 'Description'],
            ['data' => 'icon_url','name' => 'icon_url','title' => 'Icon Url'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

//dd($datatables->getRequest()->ajax());
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));


            $boards = Board::get();

            return $datatables->of($boards)
                ->editColumn('rownum', function ($boards) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('name', function ($boards) {
                    return $boards->name;
                })
                ->editColumn('description', function ($boards) {
                    return $boards->description;
                })
                ->editColumn('icon_url', function ($boards) {
                    return $boards->board_url;
                })
                ->editColumn('actions', function ($boards) {
                    return /*view('admin.boards.action', compact('boards'))->render()*/'action';
                })

                ->rawColumns(['name','description','icon_url','actions'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());

        return view('admin.board.board-list',compact('html'));


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
        return view('admin.board.create',compact('boards'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        //create the new role
        $board = new board();
        $board->name = $request->input('name');
        $board->description = $request->input('description');
        $board->icon_url = $request->input('icon_url');
        $board->save();

        return redirect()->route('list-board')
            ->with('success','Board created successfully');
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
        $board = Board::FindOrFail($id)->toArray();
        return view('admin.board.show', compact( 'board'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $board = Board::FindOrFail($id)->toArray();
        return view('admin.board.edit', compact( 'board'));
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
            'name' => 'required',
        ]);

        $board = Board::FindOrFail($id);
        if($request->input('name') != $board['name'] ){
            $board->name = $request->input('name');
        }
        if($request->input('description') != $board['description'] ){
            $board->description = $request->input('description');
        }
        if($request->input('icon_url') != $board['icon_url'] ){
            $board->icon_url = $request->input('icon_url');
        }

        $board->save();

        return redirect()->route('list-board')
            ->with('success','Board updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $boardsDetails = Board::findOrfail($id);
        $boardsDetails->delete();

        DeleteBoard::create([
            'board_id'=> $id,
            'user_id'   => Auth::id(),
            'name'      => $boardsDetails->name,
            'day'       => date('l'),
            'date'      => date('Y-m-d'),
            'time'      => date("h:i:s"),
            'reason'    => $request->input('delete_message'),
        ]);

        return redirect()->back()->with(['success'=> 'Board deleted successfully']);
    }

    public function loadDeleteBoardUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.board.deleteReason', compact('id'))->render();
    }



}
