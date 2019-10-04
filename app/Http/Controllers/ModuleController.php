<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ModuleController extends Controller
{
    public function index($project_id)
    {
        $project=Project::where(['id'=>$project_id])->first();
        $client = new \GuzzleHttp\Client();
        $request = $client->get($project->project_url);
        $response = $request->getBody();

        return response()->json(json_decode($response));
    }
    
    public function getDashboardDetails($module_type){
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('MBD_LOCAL_URL').$module_type);
        $response = $request->getBody();
        return response()->json(json_decode($response));

    }
    
}
