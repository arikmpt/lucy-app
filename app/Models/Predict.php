<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predict extends Model
{
    use HasFactory;

    protected $table = 'predicts';

    protected $fillable = [
        'name','nim','phone','email','date_of_birth','place_of_birth','gender','major','school','school_major','school_cluster','status','percentage','unpercentage'
    ];
}
