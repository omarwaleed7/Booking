<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    // use api trait
    use ApiResponseTrait;
    public function searchByLatest(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors()->first(), 422);
        }

        $rooms = Room::where('name', 'LIKE', '%' . $request->name . '%')
            ->orderBy('id', 'desc')
            ->paginate(30);

        if($rooms->count() === 0){
            return $this->apiResponse(null,'Rooms not found',404);
        }

        return $this->apiResponse($rooms,'Rooms retrieved successfully',200);
    }
    public function searchByOldest(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors()->first(), 422);
        }

        $rooms = Room::where('name', 'LIKE', '%' . $request->name . '%')
            ->orderBy('id')
            ->paginate(30);

        if($rooms->count() === 0){
            return $this->apiResponse(null,'Rooms not found',404);
        }

        return $this->apiResponse($rooms,'Rooms retrieved successfully',200);
    }
    public function searchByLowest(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors()->first(), 422);
        }

        $rooms = Room::where('name', 'LIKE', '%' . $request->name . '%')
            ->orderBy('price')
            ->paginate(30);

        if($rooms->count() === 0){
            return $this->apiResponse(null,'Rooms not found',404);
        }

        return $this->apiResponse($rooms,'Rooms retrieved successfully',200);
    }
    public function searchByHighest(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors()->first(), 422);
        }

        $rooms = Room::where('name', 'LIKE', '%' . $request->name . '%')
            ->orderBy('price','desc')
            ->paginate(30);

        if($rooms->count() === 0){
            return $this->apiResponse(null,'Rooms not found',404);
        }

        return $this->apiResponse($rooms,'Rooms retrieved successfully',200);
    }
}
