<?php

use App\Models\User;
use App\Notifications\TestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/login", function () {
    Auth::login(User::first());
});

Route::post("/notification", function (Request $request) {
    $request->user()->notify(new TestNotification);

    return response()->json('Notification sent.', 201);
});

Route::post("/sub", function (Request $request) {
    $request->user()->updatePushSubscription(
        $request->endpoint,
        $request->publicKey,
        $request->authToken,
        $request->contentEncoding ?? "aesgcm"
    );

    return response()->json('Subscribed.', 201);
});

Route::get("/vapidPublicKey", function () {
    return response(config('webpush.vapid.public_key'));
});
