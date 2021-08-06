<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRegisteration;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('contact', function () {
    return view('contact');
});
Route::get('jobs', function () {
    return view('jobs');
});
Route::get('registration', function () {
    return view('registration');
});
Route::get('services', function () {
    return view('services');
});

Route::post('reg',[UserRegisteration::class,'register']);
Route::get('show',[UserRegisteration::class,'show']);
Route::get('/delete/{id}',[UserRegisteration::class,'delete']);
Route::view('/update/{id}','update');
Route::post('/update/{id}',[UserRegisteration::class,'update']);