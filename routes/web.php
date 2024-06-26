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

// USER ROUTES
// ___ GET REQUESTS _________________________________________________________________
Route::get('/', [UserController::class, "showCorrectHomePage"])->name('login');
//____________________________________________________________________________________
// ___ POST REQUESTS ________________________________________________________________
Route::post('/register', [UserController::class, 'register'])->name('guest');
Route::post('/login', [UserController::class, 'login'])->name('guest');
Route::post('/logout', [UserController::class, 'logout'])->name('loggedIn');
//____________________________________________________________________________________


// BLOG ROUTES
// ___ GET REQUESTS _________________________________________________________________
Route::get('/create-post', [PostController::class, 'showCreateForm'])->middleware('loggedIn');
Route::get('/posts/{post}', [PostController::class, 'viewSinglePost']);
//____________________________________________________________________________________
// ___ POST REQUESTS ________________________________________________________________
Route::post('/create-post', [PostController::class, 'storeNewPost'])->middleware('loggedIn');
//____________________________________________________________________________________

// PROFILE ROUTES
// ___ GET REQUESTS _________________________________________________________________
Route::get('/profile/{user:username}', [UserController::class, 'showProfile'])->middleware('loggedIn');
//____________________________________________________________________________________
