<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function get_finance_details(Request $request){

        $post = [
            'board' => $request->board,
        ];
        if($request->board=='All Boards')
        {
            $url="http://115.124.105.59:8085/MHADAAccounting/rest/board/budget/all";
        }else
        {
            $url="http://115.124.105.59:8085/MHADAAccounting/rest/board/budget";
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
        return $response;
        //return json_encode($response);

    }
}
