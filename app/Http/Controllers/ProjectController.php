<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    public function index($board_id)
    {
        $project=Project::where(['board_id'=>$board_id])->get();
        if($project->count()>0)
        {
            $data=array(
                'status'=>0,
                'description'=>'Success',
                'data'=>$project
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
