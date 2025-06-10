<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\KomentarController;

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

// Rute untuk login dan logout
Route::get('/', [ForumController::class, 'index'])->name('forum')->middleware('iniLogin');

Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('iniLogin');

Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman')->middleware('iniLogin');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/sesi/login')->with('status', 'Anda telah keluar akun');  
})->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('iniLogin','iniAdmin');

/* -- Sesi -- */
Route::get('sesi/login', [LoginController::class, 'index'])->name('sesi.login')->middleware('iniTamu');
Route::post('/sesi/login', [LoginController::class, 'login'])->name('sesi.login')->middleware('iniTamu');

Route::get('sesi/register', [RegisterController::class, 'index'])->name('sesi.register')->middleware('iniTamu');
Route::post('/sesi/register', [RegisterController::class, 'store'])->name('sesi.register')->middleware('iniTamu');

/* -- Users -- */
Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('iniLogin');
Route::post('/users', [UserController::class, 'store'])->middleware('iniLogin');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('iniLogin');

/* -- Forum dan Admin -- */
Route::get('/forumAdmin', [ForumController::class, 'indexAdmin'])->name('forumAdmin')->middleware('iniLogin','iniAdmin');;
Route::get('/forumAdmin/create', [ForumController::class, 'createAdmin'])->name('forumAdmin.create')->middleware('iniLogin','iniAdmin');;
Route::get('/forumAdmin/{id}/edit', [ForumController::class, 'editAdmin'])->name('forumAdmin.edit')->middleware('iniLogin','iniAdmin');;
Route::get('/forum/{id}', [ForumController::class, 'show'])->name('bodyForum');
Route::delete('/forum/{id}', [ForumController::class, 'destroy']);
Route::middleware(['auth'])->group(function () {
    Route::post('/forum/{forum}/follow', [ForumController::class, 'follow'])->name('forum.follow');
    Route::post('/forum/{forum}/unfollow', [ForumController::class, 'unfollow'])->name('forum.unfollow');
});

Route::resource('forum', ForumController::class)->middleware('iniLogin');

/* -- Diskusi dan Admin -- */
Route::get('/diskusiAdmin', [DiskusiController::class, 'indexAdmin'])->name('diskusiAdmin')->middleware('iniLogin','iniAdmin');;
Route::get('/diskusiAdmin/create', [DiskusiController::class, 'createAdmin'])->name('diskusiAdmin.create')->middleware('iniLogin','iniAdmin');;
Route::get('/diskusiAdmin/{id}/edit', [DiskusiController::class, 'editAdmin'])->name('diskusiAdmin.edit')->middleware('iniLogin','iniAdmin');;
Route::delete('/diskusiAdmin/{id}', [DiskusiController::class, 'destroy']);
Route::get('/diskusi/{id}', [DiskusiController::class, 'show'])->name('diskusi')->middleware('iniLogin');
Route::post('/diskusi/{diskusi}/komentar', [KomentarController::class, 'store'])->middleware('iniLogin');
Route::post('/diskusi/{id}/komentar', [KomentarController::class, 'store'])->name('diskusi.comment')->middleware('iniLogin');


Route::resource('diskusi', DiskusiController::class)->middleware('iniLogin');

