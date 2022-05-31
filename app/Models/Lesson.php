<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Absence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $fillable = [
        'date_start',
        'date_end',
        'class',
        'room',
        'course_id'
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function absences() {
        return $this->hasMany(Absence::class);
    }
}
