<?php

use Illuminate\Database\Seeder;
use App\Role;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=[
            [
                'name'=>'admin',
                'display_name'=>'Admin'
            ],
            [
                'name'=>'co',
                'display_name'=>'Cheif Officer'
            ],
            [
                'name'=>'vp',
                'display_name'=>'Vice President'
            ]
        ];
        foreach($roles as $role)
        {
            $add_role=Role::where(['name'=>$role['name']])->first();
            if($add_role==null)
            {
                $add_role=new Role;
                $add_role->name=$role['name'];
                $add_role->display_name=$role['display_name'];
                $add_role->created_at=date('Y-m-d H:i:s');
                $add_role->updated_at=date('Y-m-d H:i:s');
                $add_role->save();
            }
            
        }
    }
}