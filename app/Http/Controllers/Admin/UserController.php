<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use App\Model\DeleteUser;
use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
            ['data' => 'name','name' => 'name','title' => 'Name'],
            ['data' => 'email','name' => 'email','title' => 'email'],
            ['data' => 'username','name' => 'username','title' => 'User Name'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

//dd($datatables->getRequest()->ajax());
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));


            $users = User::get();

            return $datatables->of($users)
                ->editColumn('rownum', function ($users) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('name', function ($users) {
                    return $users->name;
                })
                ->editColumn('email', function ($users) {
                    return $users->email;
                })
                ->editColumn('username', function ($users) {
                    return $users->username;
                })
                ->editColumn('actions', function ($users) {
                    return /*view('admin.users.action', compact('users'))->render()*/'action';
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
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.user.create');

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
            'email' => 'required|unique',
            'username' => 'required|unique',
        ]);
        //create the new role
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->save();

        return redirect()->route('list-user')
            ->with('success','User created successfully');
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
        $user = User::FindOrFail($id)->toArray();
        return view('admin.user.show', compact( 'user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::FindOrFail($id)->toArray();
        return view('admin.user.edit', compact( 'user'));
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

        $user = User::FindOrFail($id);
        if($request->input('name') != $user['name'] ){
            $user->name = $request->input('name');
        }
        if($request->input('email') != $user['email'] ){
            $user->email = $request->input('email');
        }
        if($request->input('username') != $user['username'] ){
            $user->username = $request->input('username');
        }

        $user->save();

        return redirect()->route('list-user')
            ->with('success','User updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $usersDetails = User::findOrfail($id);
        $usersDetails->delete();

        DeleteUser::create([
            'deleted_user_id'=> $id,
            'user_id'   => Auth::id(),
            'name'      => $usersDetails->name,
            'day'       => date('l'),
            'date'      => date('Y-m-d'),
            'time'      => date("h:i:s"),
            'reason'    => $request->input('delete_message'),
        ]);

        return redirect()->back()->with(['success'=> 'User deleted successfully']);
    }

    public function loadDeleteUserUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.user.deleteReason', compact('id'))->render();
    }



}
