<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\User;
use App\Role;

class BoardController extends Controller
{
    public function index(User $user)
    {
        $admin_roles_array=array();

        //get vp and admin role
        $admin_roles=Role::whereIn('name',[config('constant.roles.admin'),config('constant.roles.vp')])->get();
        foreach($admin_roles as $admin_role)
        {
            $admin_roles_array[]=$admin_role->id;
        }

        if(in_array(auth()->user()->role->id,$admin_roles_array)==true){
            $boards=Board::all();
        }else
        {
            $boards=Board::whereHas('users',function($q) use($admin_roles_array){
                $q->where('user_id',auth()->user()->id);
            })->get();
        }
        
        if($boards->count()>0)
        {
            $data=array(
                'status'=>0,
                'description'=>'Success',
                'data'=>$boards
            );
        }else
        {
            $data=array(
                'status'=>1,
                'description'=>'No record Found'
            );
        }
        
        return response()->json($data);
    }
}
