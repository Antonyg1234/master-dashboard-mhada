<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
