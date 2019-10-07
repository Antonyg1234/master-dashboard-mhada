<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use App\UserRole;
use Illuminate\Http\Request;
use Config;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
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
            ['data' => 'user_id','name' => 'user_id','title' => 'User Name'],
            ['data' => 'role_id','name' => 'role_id','title' => 'Role Name'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

//dd($datatables->getRequest()->ajax());
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));


            $users = UserRole::get();

            return $datatables->of($users)
                ->editColumn('rownum', function ($users) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('user_id', function ($users) {
                    return $users->name;
                })
                ->editColumn('role_id', function ($users) {
                    return $users->email;
                })
                ->editColumn('actions', function ($users) {
                    return view('admin.user_role.action', compact('users'))->render();
                })

                ->rawColumns(['name','email','username','actions'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());

        return view('admin.user.user-list',compact('html'));


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


}
