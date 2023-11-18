<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'location',
        'price',
        'capacity',
        'size',
        'room_facilities',
        'status',
        'main_image',
        'user_id'
    ];
    public function room_reviews(){
        return $this->hasMany(RoomReview::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reservation(){
        return $this->hasOne(Reservation::class);
    }
}
