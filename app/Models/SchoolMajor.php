<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolMajor extends Model
{
    use HasFactory;

    protected $table = 'school_majors';

    protected $fillable = [
        'name','predict_value'
    ];
}
