<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\UserRole;
use App\Board;
use App\UserBoard;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_user=[
            'name'=>'sudesh jadhav',
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('Admin@123'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ];

        $add_admin_user=User::where(['username'=>'admin'])->first();
        if($add_admin_user==null)
        {
            $add_admin_user= new User;
            $add_admin_user->name='Admin';
            $add_admin_user->username='admin';
            $add_admin_user->email='admin@gmail.com';
            $add_admin_user->password=Hash::make('admin@123');
            $add_admin_user->created_at=date('Y-m-d H:i:s');
            $add_admin_user->updated_at=date('Y-m-d H:i:s');
            $add_admin_user->save();
        }
        
        $admin_role=Role::where(['name'=>config('constant.roles.admin')])->first();
        if($admin_role==null)
        {
            $admin_role=new Role;
            $admin_role->name='admin';
            $admin_role->display_name='Admin';
            $admin_role->created_at=date('Y-m-d H:i:s');
            $admin_role->updated_at=date('Y-m-d H:i:s');
            $admin_role->save();
        }

        $admin_user_role=UserRole::where(['user_id'=>$add_admin_user->id,'role_id'=>$admin_role->id])->first();
        if($admin_user_role==null)
        {
            $admin_user_role=new UserRole;
            $admin_user_role->user_id=$add_admin_user->id;
            $admin_user_role->role_id=$admin_role->id;
            $admin_user_role->created_at=date('Y-m-d H:i:s');
            $admin_user_role->updated_at=date('Y-m-d H:i:s');
            $admin_user_role->save();
        }
        
        $mumbai_board=Board::where(['name' => config('constant.boards.MHADA')])->first();
        if($mumbai_board!=null)
        {
            $board_user=UserBoard::where(['user_id'=>$add_admin_user->id,'board_id'=>$mumbai_board->id])->first();
            if($board_user==null)
            {
                $board_user=new UserBoard;
                $board_user->user_id=$add_admin_user->id;
                $board_user->board_id=$mumbai_board->id;
                $board_user->created_at=date('Y-m-d H:i:s');
                $board_user->updated_at=date('Y-m-d H:i:s');
                $board_user->save();
            }
        }
        
        $mhadb_board=Board::where(['name' => config('constant.boards.MHADA')])->first();
        if($mumbai_board!=null)
        {
            $board_user=UserBoard::where(['user_id'=>$add_admin_user->id,'board_id'=>$mumbai_board->id])->first();
            if($board_user==null)
            {
                $board_user=new UserBoard;
                $board_user->user_id=$add_admin_user->id;
                $board_user->board_id=$mumbai_board->id;
                $board_user->created_at=date('Y-m-d H:i:s');
                $board_user->updated_at=date('Y-m-d H:i:s');
                $board_user->save();
            }
        }

        $co_user=[
            'name'=>'CO',
            'username'=>'co',
            'email'=>'co@gmail.com',
            'password'=>Hash::make('co@123'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ];

        $add_co_user=User::where(['username'=>'co'])->first();
        if($add_co_user==null)
        {
            $add_co_user= new User;
            $add_co_user->name='CO';
            $add_co_user->username='co';
            $add_co_user->email='co@gmail.com';
            $add_co_user->password=Hash::make('co@123');
            $add_co_user->created_at=date('Y-m-d H:i:s');
            $add_co_user->updated_at=date('Y-m-d H:i:s');
            $add_co_user->save();
        }
        
        $co_role=Role::where(['name'=>config('constant.roles.co')])->first();
        if($co_role==null)
        {
            $co_role=new Role;
            $co_role->name='co';
            $co_role->display_name='co';
            $co_role->created_at=date('Y-m-d H:i:s');
            $co_role->updated_at=date('Y-m-d H:i:s');
            $co_role->save();
        }

        $co_user_role=UserRole::where(['user_id'=>$add_co_user->id,'role_id'=>$co_role->id])->first();
        if($co_user_role==null)
        {
            $co_user_role=new UserRole;
            $co_user_role->user_id=$add_co_user->id;
            $co_user_role->role_id=$co_role->id;
            $co_user_role->created_at=date('Y-m-d H:i:s');
            $co_user_role->updated_at=date('Y-m-d H:i:s');
            $co_user_role->save();
        }

        $mumbai_board=Board::where(['name' => config('constant.boards.MHADB')])->first();
        if($mumbai_board!=null)
        {
            $board_user=UserBoard::where(['user_id'=>$add_co_user->id,'board_id'=>$mumbai_board->id])->first();
            if($board_user==null)
            {
                $board_user=new UserBoard;
                $board_user->user_id=$add_co_user->id;
                $board_user->board_id=$mumbai_board->id;
                $board_user->created_at=date('Y-m-d H:i:s');
                $board_user->updated_at=date('Y-m-d H:i:s');
                $board_user->save();
            }
        }
        
        $vp_user=[
            'name'=>'sudesh jadhav',
            'username'=>'vp',
            'email'=>'vp@gmail.com',
            'password'=>Hash::make('vp@123'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ];

        $add_vp_user=User::where(['username'=>'vp'])->first();
        if($add_vp_user==null)
        {
            $add_vp_user= new User;
            $add_vp_user->name='VP';
            $add_vp_user->username='vp';
            $add_vp_user->email='vp@gmail.com';
            $add_vp_user->password=Hash::make('vp@123');
            $add_vp_user->created_at=date('Y-m-d H:i:s');
            $add_vp_user->updated_at=date('Y-m-d H:i:s');
            $add_vp_user->save();
        }
        
        $vp_role=Role::where(['name'=>config('constant.roles.vp')])->first();
        if($vp_role==null)
        {
            $vp_role=new Role;
            $vp_role->name='vp';
            $vp_role->display_name='vp';
            $vp_role->created_at=date('Y-m-d H:i:s');
            $vp_role->updated_at=date('Y-m-d H:i:s');
            $vp_role->save();
        }

        $vp_user_role=UserRole::where(['user_id'=>$add_vp_user->id,'role_id'=>$vp_role->id])->first();
        if($vp_user_role==null)
        {
            $vp_user_role=new UserRole;
            $vp_user_role->user_id=$add_vp_user->id;
            $vp_user_role->role_id=$vp_role->id;
            $vp_user_role->created_at=date('Y-m-d H:i:s');
            $vp_user_role->updated_at=date('Y-m-d H:i:s');
            $vp_user_role->save();
        }
        $mumbai_board=Board::where(['name' => config('constant.boards.MHADA')])->first();
        if($mumbai_board!=null)
        {
            $board_user=UserBoard::where(['user_id'=>$add_vp_user->id,'board_id'=>$mumbai_board->id])->first();
            if($board_user==null)
            {
                $board_user=new UserBoard;
                $board_user->user_id=$add_vp_user->id;
                $board_user->board_id=$mumbai_board->id;
                $board_user->created_at=date('Y-m-d H:i:s');
                $board_user->updated_at=date('Y-m-d H:i:s');
                $board_user->save();
            }
        }
    }
}
