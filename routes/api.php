<?php

use Illuminate\Http\Request;
use App\User;
use App\Pos;
use App\Hashtag;

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

Route::get('/users', function (Request $request) {
    return User::all();
});

Route::get('/pos', function (Request $request) {
    return Pos::with('hashtags')->all();
});

Route::patch('/pos/{pos}', function (Request $request, Pos $pos) {
    $pos->fill($request->all());
});

Route::post('/pos', function(Request $request) {
    $request->validate([
        'lat' => 'required',
        'long' => 'required',
        'user_id' => 'required'
    ]);

    return Pos::create([
        'lat' => $request->lat,
        'long' => $request->long,
        'user_id' => $request->user_id,
    ]);
});

Route::patch('/hashtags/{hashtag}', function (Request $request, Hashtag $hashtag) {
    $hashtag->fill($request->all());
});

Route::get('/route', function (Request $request) {
    $request->validate([
        'user_id' => 'required'
    ]);

    return User::findOrFail($request->user_id)->route;
});

Route::post('/route', function (Request $request) {
    $request->validate([
        'route' => 'required',
        'user_id' => 'required'
    ]);

    return User::findOrFail($request->user_id)->update([
        'route' => $request->route
    ]);
});
