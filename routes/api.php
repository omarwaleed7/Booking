<?php

use App\Http\Controllers\api\ReservationController;
use App\Http\Controllers\api\RoomController;
use App\Http\Controllers\api\RoomFacilityController;
use App\Http\Controllers\api\RoomReviewController;
use App\Http\Controllers\api\SearchController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(RoomController::class)->group(function(){
   Route::post('room/create','store')->middleware('jwt.verify')->name('room.create');
   Route::get('rooms','index')->name('rooms');
   Route::get('room/{id}','show')->name('rooms');
   Route::post('room/update','update')->middleware(['jwt.verify','owner'])->name('room.update');
   Route::post('room/delete','delete')->middleware(['jwt.verify','owner'])->name('room.delete');
});


Route::controller(RoomReviewController::class)->group(function(){
    Route::post('roomreview/create','store')->middleware('jwt.verify')->name('roomreview.create');
    Route::get('roomreviews/{id}','index')->name('roomreview');
    Route::post('roomreview/update','update')->middleware(['jwt.verify','owner'])->name('roomreview.update');
    Route::post('roomreview/delete','delete')->middleware(['jwt.verify','owner'])->name('roomreview.delete');
});

Route::middleware('jwt.verify')->controller(ReservationController::class)->group(function(){
   Route::post('reservation/create','store')->name('reservation.create');
   Route::get('reservations/mybookings','myBookings')->name('reservations.mybookings');
   Route::get('reservations/myaccommodations','myAccommodations')->name('reservations.myaccommodations');
});

Route::controller(SearchController::class)->group(function(){
    Route::post('search/searchbylatest','searchByLatest')->name('search.searchbylatest');
    Route::post('search/searchbyoldest','searchByOldest')->name('search.searchbyoldest');
    Route::post('search/searchbylowest','searchByLowest')->name('search.searchbylowest');
    Route::post('search/searchbyhighest','searchByHighest')->name('search.searchbyhighest');
});

Route::middleware('jwt.verify')->controller(UserController::class)->group(function(){
    Route::post('profile/update','updateProfile')->name('profile.update')->middleware('owner');
    Route::post('profile/delete','deleteProfile')->name('profile.delete');
});
