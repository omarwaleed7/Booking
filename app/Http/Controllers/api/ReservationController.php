<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    // use api trait
    use ApiResponseTrait;

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'date_from' => 'required|date|after_or_equal:today',
            'date_to' => 'required|date|after:date_from',
            'room_id' => 'required|exists:rooms',
            'user_id' => 'required|exists:users',
            'room_owner_id' => 'required|exists:users',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors()->first(), 422);
        }

        $reservation = Reservation::create([
            'date_from'=>$request->date_from,
            'date_to'=>$request->date_to,
            'room_id'=>$request->room_id,
            'user_id'=>Auth()->User()->id,
            'room_owner_id'=>$request->room_owner_id,
        ]);

        $update_room_status = Room::where('room_id',$request->room_id)->update([
            'status'=>1
        ]);

        return $this->apiResponse($reservation,'Reservation created successfully',200);
    }

    public function myBookings(){
        $bookings = Reservation::where('user_id',Auth()->User()->id)->get();

        if($bookings->count() === 0){
            return $this->apiResponse(null,'Bookings not found',404);
        }

        return $this->apiResponse($bookings,'Bookings retrieved successfully',200);
    }

    // show my accommodations by user id
    public function myAccommodations(){
        $accommodations = Reservation::where('room_owner_id',Auth()->User()->id);

        if($accommodations->count() === 0){
            return $this->apiResponse(null,'Accommodations not found',404);
        }

        return $this->apiResponse($accommodations,'Bookings retrieved successfully',200);
    }
}
