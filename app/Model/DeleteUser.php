<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeleteUser extends Model
{
    protected $table    = 'delete_user';
    protected $fillable = [ 'deleted_user_id',
        'user_id',
        'name',
        'day',
        'date',
        'time',
        'reason',
    ];
}