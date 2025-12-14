<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return 'test api';
});

Route::get('/v1/test-redis', function () {
    $users = unserialize(Redis::get("userList"));
    /* dd($users, 'before'); */
    if (empty($users)) {
        $users = User::all();
        Redis::set("userList", serialize($users));
        dd('set', $users);
    }

    dd($users);
});
