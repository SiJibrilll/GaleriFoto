<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\TmpImageController;

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
});

// -- logout
Route::post('/logout', [AuthController::class, 'logout']);

// -- home page
Route::get('/', [PostController::class, 'index']);

 // -- show post
 Route::get('/posts/show/{post}', [PostController::class, 'show']);


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
});
