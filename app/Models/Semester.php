<?php

namespace App\Models;

use App\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $fillable = [
        'date_start','date_end','number'
    ];

    public function modules() {
        return $this->hasMany(Module::class); 
    }
}
