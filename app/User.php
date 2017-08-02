<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'job_title', 'mobile', 'avatar_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getThumbnailAttribute()
    {
        return $this->avatar ? $this->avatar->thumbnail() : route('generate.avatar', $this->id);
    }

    public function avatar()
    {
        return $this->hasOne(Avatar::class, 'id', 'avatar_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
