<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // use api trait
    use ApiResponseTrait;

    // store a room
    public function store(UpdateRoomRequest $request){
        $image = time() . '_' . $request->file('main_image')->getClientOriginalName();

        $path = $request->file('main_image')->storeAs('rooms_main_imgs',$image,'rooms_main_img');

        $room = Room::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'location'=>$request->location,
            'price'=>$request->price,
            'capacity'=>$request->capacity,
            'size'=>$request->size,
            'room_facilities'=>$request->room_facilities,
            'main_image'=>$path,
            'user_id'=>$request->user_id
        ]);

        return $this->apiResponse($room,'Room created successfully',201);
    }

    // show rooms
    public function index(){
        $rooms = Room::orderBy('id', 'desc')->paginate(30);

        if($rooms->count() == 0){
            return $this->apiResponse(null,'Rooms not found',404);
        }

        return $this->apiResponse($rooms,'Rooms retrieved successfully',200);
    }

    // show a room by id
    public function show($id){
        $room = Room::find($id);

        if($room === null){
            return $this->apiResponse(null,'Room not found',404);
        }

        return $this->apiResponse($room,'Room retrieved successfully',200);
    }

    // update a room by id
    public function update(UpdateRoomRequest $request){
        $room = Room::find($request->id);

        if($room === null){
            return $this->apiResponse(null,'Room not found',404);
        }

        $image = time() . '_' . $request->file('main_image')->getClientOriginalName();

        $path = $request->file('main_image')->storeAs('rooms_main_imgs',$image,'rooms_main_img');

        $room->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'location'=>$request->location,
            'price'=>$request->price,
            'capacity'=>$request->capacity,
            'size'=>$request->size,
            'main_image'=>$path,
        ]);

        $updated_room = Room::find($request->id);

        return $this->apiResponse($updated_room,'Room updated successfully',200);
    }

    // delete room by id
    public function delete(Request $request){
        $room = Room::find($request->id);

        if($room === null){
            return $this->apiResponse(null,'Room not found',404);
        }

        $room->delete($request->id);

        return $this->apiResponse(null,'Room deleted successfully',204);
    }
}
