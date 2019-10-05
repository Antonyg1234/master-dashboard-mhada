<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeleteProject extends Model
{
    protected $table    = 'delete_project';
    protected $fillable = [ 'project_id',
        'user_name',
        'name',
        'day',
        'date',
        'time',
        'reason',
    ];
}