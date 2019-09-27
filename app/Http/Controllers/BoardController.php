<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;

class BoardController extends Controller
{
    public function index()
    {
        $boards=Board::all();
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
