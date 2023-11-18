<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomReviewRequest;
use App\Models\Reservation;
use App\Models\RoomReview;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomReviewController extends Controller
{
    // use api trait
    use ApiResponseTrait;

    // store room review
    public function store(StoreRoomReviewRequest $request){
        if (Auth::id() == $request->room_owner_id){
            return $this->apiResponse(null,'User cant rate own room',401);
        }

        $reservation = Reservation::where('user_id',Auth::id())->get();

        if($reservation == null){
            return $this->apiResponse(null,'User can not review non reserved rooms',401);
        }

        $room_review = RoomReview::where('user_id',Auth::id())->get();

        if($room_review){
            return $this->apiResponse(null,'User can not review more than one time',401);
        }

        $room_review = RoomReview::create([
            'description'=>$request->description,
            'rate'=>$request->rate,
            'user_id'=>auth()->user()->id,
            'room_id'=>$request->room_id
        ]);

        return $this->apiResponse($room_review,'Room review created successfully',201);
    }

    // show room reviews by room id
    public function index($id){
        $room_reviews = RoomReview::where('room_id',$id)->paginate(20);

        if($room_reviews->count() == 0){
            return $this->apiResponse(null,'Room reviews not found',404);
        }

        return $this->apiResponse($room_reviews,'Room reviews retrieved successfully',200);
    }

    // update room review by id
    public function update(Request $request){
        $room_review = RoomReview::find($request->id);

        if($room_review === null){
            return $this->apiResponse(null,'Room review not found',404);
        }

        $request->validate([
            'description' => 'required',
            'rate' => 'required|numeric',
        ]);

        $room_review->update([
            'description'=>$request->description,
            'rate'=>$request->rate
        ]);

        $updated_room_review = RoomReview::find($request->id);

        return $this->apiResponse($updated_room_review,'Room review updated successfully',200);
    }

    // delete room review by id
    public function delete($id){
        $room_review = RoomReview::find($id);

        if($room_review === null){
            return $this->apiResponse(null,'Room review not found',404);
        }

        $room_review->delete();

        return $this->apiResponse(null, 'Room review deleted successfully',204);
    }
}
