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
    return Pos::with('hashtags')->get();
});

Route::post('/pos/upvote/{pos}', function (Request $request, Pos $pos) {
    $pos->upvotes += 1;
    $pos->save();

    return $pos;
});

Route::post('/pos/downvote/{pos}', function (Request $request, Pos $pos) {
    $pos->upvotes -= 1;
    $pos->save();

    return $pos;
});

Route::patch('/pos/{pos}', function (Request $request, Pos $pos) {
    $pos->fill($request->all());

    if($request->has('hashtags')) {
        $pos->hashtags()->createMany($request->hashtags);
    }

    return $pos;
});

Route::post('/pos', function(Request $request) {
    $request->validate([
        'lat' => 'required',
        'lng' => 'required',
        'user_id' => 'required'
    ]);

    $pos = Pos::create([
        'lat' => $request->lat,
        'lng' => $request->lng,
        'user_id' => $request->user_id,
    ]);

    if($request->has('hashtags')) {
        $pos->hashtags()->createMany($request->hashtags);
    }

    return $pos;
});

Route::patch('/hashtags/{hashtag}', function (Request $request, Hashtag $hashtag) {
    return $hashtag->fill($request->all());
});

Route::post('/hashtags/upvote/{hashtag}', function (Request $request, Hashtag $hashtag) {
    $hashtag->upvotes += 1;
    $hashtag->save();

    return $hashtag;
});

Route::post('/hashtags/downvote/{hashtag}', function (Request $request, Hashtag $hashtag) {
    $hashtag->upvotes -= 1;
    $hashtag->save();

    return $hashtag;
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

    $user = User::findOrFail($request->user_id);
    $user->route = $request->route;
    $user->save();

    return $user;
});

// TODO:
// - lat und long übergeben bei route erstellen
// - lat long bei route abfragen
// - long -> lng umbenennen
