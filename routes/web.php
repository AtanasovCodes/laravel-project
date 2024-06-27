<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

// ADMIN  ROUTES



// USER ROUTES

// ___ GET REQUESTS _________________________________________________________________
Route::get('/', [UserController::class, "showCorrectHomePage"])->name('login');
//____________________________________________________________________________________
// ___ POST REQUESTS ________________________________________________________________
Route::post('/register', [UserController::class, 'register'])->name('guest');
Route::post('/login', [UserController::class, 'login'])->name('guest');
Route::post('/logout', [UserController::class, 'logout'])->name('loggedIn');
//____________________________________________________________________________________

// POST ROUTES

// ___ GET REQUESTS _________________________________________________________________
Route::get('/create-post', [PostController::class, 'showCreateForm'])->middleware('loggedIn');
Route::get('/post/{post}', [PostController::class, 'viewSinglePost']);
Route::get('/post/{post}/edit', [PostController::class, 'showEditForm'])->middleware('loggedIn')->middleware('can:update,post');
//____________________________________________________________________________________
// ___ POST REQUESTS ________________________________________________________________
Route::post('/create-post', [PostController::class, 'storeNewPost'])->middleware('loggedIn');
// ___ DELETE REQUESTS ______________________________________________________________
Route::delete('/post/{post}', [PostController::class, 'delete'])->middleware('loggedIn')->middleware('can:delete,post');
// ___  PUT REQUESTS ________________________________________________________________
Route::put('/post/{post}', [PostController::class, 'update'])->middleware('loggedIn')->middleware('can:update,post');
//____________________________________________________________________________________



// PROFILE ROUTES

// ___ GET REQUESTS _________________________________________________________________
Route::get('/profile/{user:username}', [UserController::class, 'showProfile'])->middleware('loggedIn');
//____________________________________________________________________________________
