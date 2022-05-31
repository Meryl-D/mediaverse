<?php

namespace App\Models;

use App\Models\User;
use App\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sector extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $fillable = [
        'name'
    ];

    public function users() {
        return $this->hasMany(User::class);     
    }
    public function modules() {
        return $this->hasMany(Module::class);     
    }
}
