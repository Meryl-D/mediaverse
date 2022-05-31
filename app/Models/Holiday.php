<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'date_start',
        'date_end'
    ];
}
