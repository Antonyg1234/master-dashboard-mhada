<?php

use App\Board;
use App\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            [
                'name' => 'mbd',
                'board_id' => Board::where(['name' => config('constant.boards.MHADB')])->value('id'),
                'description' => 'Mumbai Board Computerization',
                'project_url' => 'http://mhada.php-dev.in/api/mbd_dashboard',
                'modules_count'=>'14',
                'has_modules'=>1
            ],
            [
                'name' => 'mtl',
                'board_id' => Board::where(['name' => config('constant.boards.MHADA')])->value('id'),
                'description' => 'Material Testing Lab',
                'project_url' => 'https://mtl.mhada.gov.in/api/mtl_dashboard',
                'modules_count'=>'1',
                'has_modules'=>0
            ],
            [
                'name' => 'Masterlist',
                'board_id' => Board::where(['name' => config('constant.boards.MBRRB')])->value('id'),
                'description' => 'Masterlist Application',
                'project_url' => 'http://masterlist.mhada.gov.in/admin/ApiDashboard/api_dashboard',
                'modules_count'=>'1',
                'has_modules'=>0
            ],
            [
                'name' => 'E Billing',
                'board_id' => Board::where(['name' => config('constant.boards.MBRRB')])->value('id'),
                'description' => 'E Billing',
                'project_url' => 'http://rrebilling.mhada.gov.in/api/rrbilling_dashboard',
                'modules_count'=>'1',
                'has_modules'=>0
            ]
        ];
        Project::truncate();
        foreach($projects as $project)
        {
            $add_project=Project::where(['name'=>$project['name']])->first();
            if($add_project==null)
            {
                if($project['board_id']!=null)
                {
                    $add_project=new Project;
                    $add_project->name=$project['name'];
                    $add_project->board_id=$project['board_id'];
                    $add_project->description=$project['description'];
                    $add_project->project_url=$project['project_url'];
                    $add_project->modules_count=$project['modules_count'];
                    $add_project->has_modules=$project['has_modules'];
                    $add_project->created_at=date('Y-m-d H:i:s');
                    $add_project->updated_at=date('Y-m-d H:i:s');
                    $add_project->save();
                }
            }else
            {
                $add_project->board_id=$project['board_id'];
                $add_project->description=$project['description'];
                $add_project->has_modules=$project['has_modules'];
                $add_project->project_url=$project['project_url'];
                $add_project->modules_count=$project['modules_count'];
                $add_project->updated_at=date('Y-m-d H:i:s');
                $add_project->save();
            }
        }
    }
}
