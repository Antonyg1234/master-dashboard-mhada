<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOneThrough(\App\Role::class,\App\UserRole::class,'user_id','id');
    }

    public function boards()
    {
        return $this->hasManyThrough(\App\Board::class,\App\UserBoard::class,'user_id','id');
    }

    public function roles()
    {
        return $this->belongsToMany(\App\Role::class,\App\UserRole::class,'user_id','role_id');
    }

    public function board()
    {
        return $this->belongsToMany(\App\Board::class,\App\UserBoard::class,'user_id','board_id');
    }
}
