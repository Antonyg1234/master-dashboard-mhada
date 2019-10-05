<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = ['id','board_id','name','description', 'project_url'];

    public function Board(){

        return $this->belongsTo('App\Board');

    }

    public function getBoardName()
    {
        return $this->hasOne('App\Board', 'id','board_id');
    }
}
