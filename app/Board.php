<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public function users()
    {
        return $this->belongsToMany(\App\User::class,'user_boards','board_id','user_id');
    }
}
