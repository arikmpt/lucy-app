<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMother extends Model
{
    use HasFactory;

    protected $table = 'user_mothers';

    protected $fillable = [
        'name','job','address','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
