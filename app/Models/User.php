<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name','nim','phone','email','password','date_of_birth','place_of_birth','gender','major'
    ];

    public function father()
    {
        return $this->hasOne(UserFather::class, 'user_id');
    }

    public function mother()
    {
        return $this->hasOne(UserMother::class, 'user_id');
    }

    public function school()
    {
        return $this->hasOne(UserSchool::class, 'user_id');
    }
}
