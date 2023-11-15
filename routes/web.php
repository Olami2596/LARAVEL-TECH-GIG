<?php

use App\Models\Gig;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GigController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;

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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  


//all gigs
Route::get('/', [GigController::class, 'index']);


//show create form
Route::get('/gigs/create', [GigController::class, 'create'])->middleware('auth');

//store gig data
Route::post('/gigs', [GigController::class, 'store'])->middleware('auth');;

//show edit form
// Route::get('/gigs', [GigController::class, 'edit']);
Route::get('/gigs/{gig}/edit', [GigController::class, 'edit'])->middleware('auth');;

//update listing
Route::put('/gigs/{gig}', [GigController::class, 'update'])->middleware('auth');;

//delete listing
Route::delete('/gigs/{gig}', [GigController::class, 'destroy'])->middleware('auth');

//manage gig
Route::get('/gigs/manage', [GigController::class, 'manage'])->middleware('auth');;

//single gig
Route::get('/gigs/{gig}', [GigController::class, 'show']);

//show register/create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//create new user
Route::post('/users', [UserController::class, 'store']);

//log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');;

//login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// //making sure only authenticated users can post a job
// Route::get('/post-job', 'GigController@create')->name('post-job')->middleware('auth');

