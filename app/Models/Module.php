<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Sector;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'credit', 'name','semester_id','sector_id','acronym'
    ];

    public function semester() {
        return $this->belongsTo(Semester::class);
    }

    public function sector() {
        return $this->belongsTo(Sector::class);
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }
}
