<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_from',
        'date_to',
        'room_id',
        'user_id',
        'room_owner_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function room(){
        return $this->hasOne(Room::class);
    }
}
