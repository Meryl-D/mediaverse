<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $fillable = [
        'name','dateStart','dateEnd', 'description','user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
