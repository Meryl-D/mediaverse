<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'message',
        'date',
        'sender_id'
    ];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receivers() {
        return $this->belongsToMany(User::class, 'receiver_id');
    }
}
