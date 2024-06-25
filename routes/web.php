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
Route::get('/', [UserController::class, "showCorrectHomePage"]);
//____________________________________________________________________________________
// ___ POST REQUESTS ________________________________________________________________
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
//____________________________________________________________________________________


// BLOG ROUTES
// ___ GET REQUESTS _________________________________________________________________
Route::get('/create-post', [PostController::class, 'showCreateForm']);
Route::get('/posts/{post}', [PostController::class, 'viewSinglePost']);
//____________________________________________________________________________________
// ___ POST REQUESTS ________________________________________________________________
Route::post('/create-post', [PostController::class, 'storeNewPost']);
//____________________________________________________________________________________
