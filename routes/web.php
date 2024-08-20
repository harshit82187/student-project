<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::controller(AuthController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/register', 'register')->name('register');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');

});


