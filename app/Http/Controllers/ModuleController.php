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
        $request = $client->get(env('MBD_LOCAL_URL').'/'.$module_type);
        $response = $request->getBody();
        return response()->json(json_decode($response));

    }
    

    public function get_details($module_url)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get($module_url);
        $response = $request->getBody();

        return response()->json(json_decode($response));
    }

    public function get_dashboard_details(Request $request)
    {
        $requestUrl     =   urldecode($request->url['url']);
        $response   =   [];
        /*echo $request->url['project_name'];*/

        /*if(array_key_exists('project_name', $request->url) && ((stripos($request->url['project_name'],'Payroll' )) > -1)) {
            $boardName =    $request->url['board_name'];
        }  else {*/
            $client = new \GuzzleHttp\Client();
            $requestData = $client->get($requestUrl);
            $response = $requestData->getBody();
        /*}*/
        $returnArray    =   json_decode($response,1);
        $returnArray['data']    =     array_filter($returnArray['data'], function ($value) {
            return ((!empty($value) || $value === 0 || $value==='0') && ($value != 'null'));
        });
        return response()->json($returnArray);
    }
}
