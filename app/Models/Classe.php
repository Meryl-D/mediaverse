<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=[
        'name',
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
