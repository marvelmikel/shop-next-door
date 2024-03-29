<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

//Admin route login
Route::match(['get','post'],'login', 'AdminController@login');

Route::group(['middleware' => ['admin']], function(){
    // Admin Dashboard Route
Route::get('dashboard', 'AdminController@dashboard');

//Update Admin Password
Route::match(['get','post'], 'update-admin-password', 'AdminController@updateAdminPassword');

//Check Admin Password
Route::post('check-admin-password', 'AdminController@checkAdminPassword');

//Update Admin Details
Route::Match(['get', 'post'], 'update-admin-details','AdminController@updateAdminDetails');

//Update Vendor Details
Route::match(['get','post'], 'update-vendor-details/{slug}', 'AdminController@updateVendorDetails');

// Admin logout
Route::get('logout', 'AdminController@logout');

   });
});

