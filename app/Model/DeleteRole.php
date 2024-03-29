<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeleteRole extends Model
{
    protected $table    = 'delete_role';
    protected $fillable = [ 'deleted_role_id',
        'user_id',
        'name',
        'day',
        'date',
        'time',
        'reason',
    ];
}