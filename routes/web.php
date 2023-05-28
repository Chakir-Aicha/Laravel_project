<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomtypeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PagesController;
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
    return view('auth.login');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('admin', function () {
    return view('dashboard');
})->name('admin');

Route::get('/home', function(){
    return view('dashboard');
});
Auth::routes();
//Roomtype routes
Route::get('/admin/roomtype/{id}/delete',[RoomtypeController::class,'destroy']);
Route::resource('admin/roomtype',RoomtypeController::class);
//Room routes
Route::get('/admin/room/{id}/delete',[RoomController::class,'destroy']);
Route::resource('admin/room',RoomController::class);
//Customer routes
Route::get('/admin/customer/{id}/delete',[CustomerController::class,'destroy']);
Route::resource('admin/customer',CustomerController::class);
//Booking routes
Route::get('/admin/reservation/{id}/delete',[ReservationController::class,'destroy']);
Route::resource('admin/reservation',ReservationController::class);
Route::post('/save_contactus',[PagesController::class,'save_contactus'])->name('save_contactus');
