<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolCluster extends Model
{
    use HasFactory;

    protected $table = 'school_clusters';

    protected $fillable = [
        'name','districts'
    ];
}
