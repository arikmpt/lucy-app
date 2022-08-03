<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umur extends Model
{
    use HasFactory;

    protected $table = 'umurs';

    protected $fillable = [
        'name','start_range','end_range','predict_value'
    ];
}
