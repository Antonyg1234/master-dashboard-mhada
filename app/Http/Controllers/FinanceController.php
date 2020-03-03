<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function get_finance_details(Request $request){

        $post = [
            'board' => $request->board,
        ];
        $totalBudgetUrl   =   '';
        $totalBudgetResponse    =   [];

        if($request->board=='All Boards')
        {
            $url="http://115.124.105.59:8085/MHADAAccounting/rest/board/budget/all";
            $totalBudgetUrl =   "http://203.129.224.86:8085/MHADAAccounting/rest/board/totalBudget?boardName=all";
        }else
        {
            $url="http://115.124.105.59:8085/MHADAAccounting/rest/board/budget";
            $totalBudgetUrl =   "http://203.129.224.86:8085/MHADAAccounting/rest/board/totalBudget?boardName=".urlencode(str_ireplace(" board", '',$request->board  ));
        }

        if(!empty($totalBudgetUrl)){
            $ch = curl_init($totalBudgetUrl);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $totalBudgetResponseString = curl_exec($ch);
            $totalBudgetResponse    =   json_decode($totalBudgetResponseString,1);
            curl_close($ch);
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $response   =   json_decode($response, 1);

        if(!empty($totalBudgetResponse) && array_key_exists('data', $totalBudgetResponse) && !empty($totalBudgetResponse['data'])){
            $response['totalData']  =   $totalBudgetResponse['data'][0];
        }

        return json_encode($response);
        //return json_encode($response);
    }
}
