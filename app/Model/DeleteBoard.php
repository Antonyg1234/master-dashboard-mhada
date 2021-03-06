<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeleteBoard extends Model
{
    protected $table    = 'delete_board';
    protected $fillable = [ 'deleted_board_id',
        'user_id',
        'name',
        'day',
        'date',
        'time',
        'reason',
    ];
}