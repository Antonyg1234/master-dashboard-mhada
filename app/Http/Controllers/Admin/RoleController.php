<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\Http\Controllers\Controller;
use App\Model\DeleteRole;
use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
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
            ['data' => 'name','name' => 'name','title' => 'Role Name'],
            ['data' => 'display_name','name' => 'display_name','title' => 'Display Name'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

//dd($datatables->getRequest()->ajax());
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));


            $roles = Role::get();

            return $datatables->of($roles)
                ->editColumn('rownum', function ($roles) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('name', function ($roles) {
                    return $roles->name;
                })
                ->editColumn('display_name', function ($roles) {
                    return $roles->display_name;
                })
                ->editColumn('actions', function ($roles) {
                    return view('admin.role.action', compact('roles'))->render();
                })

                ->rawColumns(['name','display_name','actions'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());

        return view('admin.role.role-list',compact('html'));


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
        return view('admin.role.create');

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
            'display_name' => 'required',
        ]);
        //create the new role
        $role = new Role();
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->save();

        return redirect()->route('list-role')
            ->with('success','Role created successfully');
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
        $role = Role::FindOrFail($id)->toArray();
        return view('admin.role.show', compact( 'role'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::FindOrFail($id)->toArray();
        return view('admin.role.edit', compact( 'role'));
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
            'display_name' => 'required',
        ]);

        $role = Role::FindOrFail($id);
        if($request->input('name') != $role['name'] ){
            $role->name = $request->input('name');
        }
        if($request->input('display_name') != $role['display_name'] ){
            $role->display_name = $request->input('display_name');
        }
        $role->save();

        return redirect()->route('list-role')
            ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $rolesDetails = Role::findOrfail($id);
        $rolesDetails->delete();

        DeleteRole::create([
            'deleted_role_id'=> $id,
            'user_id'   => Auth::id(),
            'name'      => $rolesDetails->name,
            'day'       => date('l'),
            'date'      => date('Y-m-d'),
            'time'      => date("h:i:s"),
            'reason'    => $request->input('delete_message'),
        ]);

        return redirect()->route('list-role')->with(['success'=> 'Role deleted successfully']);
    }

    public function loadDeleteRoleUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.role.deleteReason', compact('id'))->render();
    }



}
