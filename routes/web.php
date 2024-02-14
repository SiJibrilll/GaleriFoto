<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\TmpImageController;
use App\Http\Controllers\UserController;
use App\Models\Album;

/*
TODO HOMERWORKS:

the main layout pop up is still not responsive

put the infinite scroll trigger abit higher so user would not feel the loading ✅

the display post on the user profile page seems to bug out, it displays duplicate posts

the comment bar on my phone fills the whole screen, closing it is impossible ✅
*/

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
// ============================== AUTHENTICATION ==================
Route::group(['middleware' => ['guest']], function () {
    // -- login page
    Route::get('/login', [AuthController::class, 'login'])->name('login');

    // -- redirect to SSO login or register
    Route::get('/auth/google/redirect', [GoogleController::class, 'redirect']);

    // -- callback after SSO login or register
    Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

    // -- redirect this thing into login because we didnt have a login yet
    Route::post('/authenticate', [AuthController::class, 'authenticate']);
});


// ========================= General function =====================
// -- logout
Route::post('/logout', [AuthController::class, 'logout']);

// -- home page
Route::get('/', [PostController::class, 'index']);

// -- show post
Route::get('/posts/show/{post}', [PostController::class, 'show']);

// -- show all post images
Route::get('/posts/images/show/{post}', [PostController::class, 'image']);

// -- search page
Route::get('/posts/search', [PostController::class, 'search']);

// ========================= logged in functions ===================
Route::group(['middleware' => ['auth']], function () {
    // -- create form
    Route::get('/posts/create', [PostController::class, 'create']);

    // -- simpan tmp image
    Route::post('/tmp-image/create', [TmpImageController::class, 'create']);

    // -- hapus tmp image
    Route::delete('/tmp-image/delete', [TmpImageController::class, 'delete']);

    // -- store post
    Route::post('/posts/store', [PostController::class, 'store']);

    // -- edit post page
    Route::get('/posts/edit/{post}', [PostController::class, 'edit']);

    // -- update post
    Route::post('/posts/update/{post}', [PostController::class, 'update']);
    
    // -- delete post
    Route::post('/posts/delete/{post}', [PostController::class, 'delete']);

    // -- display album contents
    Route::get('/albums/show/{album}', [AlbumController::class, 'show']);

    // -- profile page
    Route::get('/users/show/{user}', [UserController::class, 'show']);
});
