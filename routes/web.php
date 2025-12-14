<?php

use App\Models\User;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-redis', function () {
    $users = unserialize(Redis::get("userList"));
    /* dd($users, 'before'); */
    if (empty($users)) {
        $users = User::all();
        Redis::set("userList", serialize($users));
        dd('set', $users);
    }

    dd($users);
});

Route::get('/flush-redis', function () {
    Redis::del('userList');
    return;
});
