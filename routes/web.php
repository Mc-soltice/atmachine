<?php

use App\Http\Controllers\AuthControler;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('authentication/sign-in/basic');
});
Route::get('/login', function () {
    return view('authentication.sign-in.basic');
})->name('login');


Route::post('/connection', [AuthControler::class, 'login'])->name('connection');
Route::get('/sing-in', [AuthControler::class, 'signIn'])->name('sign');
Route::get('/register', [AuthControler::class, 'register'])->name('register');
Route::post('/sign-up', [AuthControler::class, 'createUserAccount'])->name('create.user.account');

Route::group(['prefix' => 'admin', 'middleware' => 'auth','ThrottleRequests'], function(){
    Route::get('/dashboard', [AuthControler::class, 'dashboard'])->name('dashboard');
});
