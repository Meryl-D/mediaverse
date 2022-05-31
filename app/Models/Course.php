<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Result;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $fillable = [
        'acronym',
        'description',
        'name',
        'total_periods',
        'weight',
        'module_id'
    ];

    public function module() {
        return $this->belongsTo(Module::class);
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
    
    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function results() {
        return $this->hasMany(Result::class);
    }
}
