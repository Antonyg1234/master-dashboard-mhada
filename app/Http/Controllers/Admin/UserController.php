<?php

namespace App\Http\Controllers\Admin;

use App\Board;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use App\Model\DeleteUser;
use App\UserBoard;
use App\UserRole;
use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
                    return view('admin.user.action', compact('users'))->render();
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
        $boards = Board::get();
        $roles = Role::get();
        return view('admin.user.create',compact('boards','roles'));

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
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users',
            'password' => 'required',
            'board' => 'required',
            'role' => 'required',
        ]);
        //create the new role
        DB::beginTransaction();

        try{
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->password = Hash::make($request->input('password'));
            $user->save();
            $user->roles()->sync($request->role);
            $user->board()->sync($request->board);
            DB::commit();
            return redirect()->route('list-user')
                ->with('success','User created successfully');
        } catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('list-user')
                ->with('danger','Something Went Wrong');
        }


    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::FindOrFail($id)->toArray();
        $userBoards = UserBoard::where('user_id',$id)->pluck('board_id')->toArray();
        $userRoles = UserRole::where('user_id',$id)->pluck('role_id')->toArray();
        $boards = Board::get();
        $roles = Role::get();

        return view('admin.user.show', compact( 'user','boards','roles','userBoards','userRoles'));
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
        $userBoards = UserBoard::where('user_id',$id)->pluck('board_id')->toArray();
        $userRoles = UserRole::where('user_id',$id)->pluck('role_id')->toArray();
        $boards = Board::get();
        $roles = Role::get();
        return view('admin.user.edit', compact( 'user','boards','roles','userBoards','userRoles'));
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
            'email' => 'required|email',
            'username' => 'required',
            'board' => 'required',
            'role' => 'required',
        ]);

        DB::beginTransaction();

        try{
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
            if (isset($request->password) && (!(Hash::check($request->input('password'), $user->password)))) {
                $user->password = Hash::make($request->input('password'));
            }

            $user->save();
            $user->roles()->sync($request->role);
            $user->board()->sync($request->board);
            DB::commit();

            return redirect()->route('list-user')
                ->with('success','User updated successfully');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('list-user')
                ->with('danger','Something Went Wrong');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $usersDetails = User::findOrfail($id);
            $usersDetails->delete();

            UserBoard::where('user_id',$id)->delete();

            UserRole::where('user_id',$id)->delete();

            DeleteUser::create([
                'deleted_user_id'=> $id,
                'user_id'   => Auth::id(),
                'name'      => $usersDetails->name,
                'day'       => date('l'),
                'date'      => date('Y-m-d'),
                'time'      => date("h:i:s"),
                'reason'    => $request->input('delete_message'),
            ]);

            DB::commit();

            return redirect()->route('list-user')->with(['success'=> 'User deleted successfully']);

        } catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('list-user')
                ->with('danger','Something Went Wrong');
        }
    }

    public function loadDeleteUserUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.user.deleteReason', compact('id'))->render();
    }

    /**
     * Assign role to the specific user.
     *
     * @param  int  $user_id
     * @return Response
     */
    public function userRoles($user_id){

        $roles = Role::get();
        $user_name = User::where('id',$user_id)->value('name');
        $user_roles = UserRole::where('user_id',$user_id)->pluck('role_id')->toArray();
        Return view('admin.user.roles',compact('roles','user_name','user_id','user_roles'));
    }

    /**
     * Store roles of the specific user.
     *
     * @param  int  $user_id
     * @return Response
     */
    public function storeUserRoles(Request $request, $user_id){

        $user = User::find($user_id);
        $roles = $request->roles;
        $user->roles()->sync($roles);

        return redirect()->back()->with(['success'=> 'Role has been assign to user successfully']);
    }


    /**
     * Assign board to the specific user.
     *
     * @param  int  $user_id
     * @return Response
     */
    public function userBoards($user_id){

        $boards = Board::get();
        $user_name = User::where('id',$user_id)->value('name');
        $user_boards = UserBoard::where('user_id',$user_id)->pluck('board_id')->toArray();
//        dd($user_boards);
        Return view('admin.user.boards',compact('boards','user_name','user_id','user_boards'));
    }
    /**
     * Store boards of the specific user.
     *
     * @param  int  $id
     * @return Response
     */
    public function storeUserBoards(Request $request, $user_id){

        $user = User::find($user_id);
        $boards = $request->boards;
        $user->board()->sync($boards);

        return redirect()->back()->with(['success'=> 'Board has been assign to user successfully']);
    }
}
