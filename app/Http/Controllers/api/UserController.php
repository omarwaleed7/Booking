<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // use api trait
    use ApiResponseTrait;

    // update profile
    public function updateProfile(Request $request){
        $user = User::find(auth()->user()->id);

        if($user === null){
            return $this->apiResponse(null,'User not found');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|exists:users',
            'password' => 'required|string|confirmed|min:6',
            'phone' => 'required|string',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors()->first(), 422);
        }

        $image = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
        $path = $request->file('profile_picture')->storeAs('user_profile_imgs',$image,'user_profile_img');

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password' => bcrypt($request->password),
            'profile_picture'=>$path
        ]);

        $updated_user = User::find(auth()->user()->id);

        return $this->apiResponse($updated_user,'User updated successfully',200);
    }

    // delete profile
    public function deleteProfile(Request $request){
        $user = User::find(auth()->user()->id);

        if($user === null){
            return $this->apiResponse(null,'User not found');
        }

        $user->delete();

        return $this->apiResponse(null,'User deleted successfully',204);
    }

}
