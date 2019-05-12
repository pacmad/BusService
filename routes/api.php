<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Routing for endpoint which checks seats availability
Route::get("seats/{busNumber}/{date}/{hour}/{passengersCapacity?}","SeatsManagerController@checkAvailableSeats");

//Routing for endpoint which makes reservation of seat in the bus
Route::post("reservation","SeatsManagerController@makeReservation");

//Routing for endpoint which makes cancelation of seat in the bus
Route::post("cancelReservation","SeatsManagerController@cancelReservation");
