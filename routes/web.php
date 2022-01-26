<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
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
    return redirect('posts');
});

Auth::routes();

 Route::resource('posts',PostController::class);
 Route::post('/comment/store', [CommentController::class,'store'])->name('comment.add')->middleware('auth');
 Route::post('/reply/store', [CommentController::class,'replyStore'])->name('reply.add')->middleware('auth');

 Route::get('/change-password', [HomeController::class, 'changePassword'])->name('ShowChangePassword');
Route::post('/change-password', [HomeController::class, 'changePasswordStore'])->name('ChangePassword');
