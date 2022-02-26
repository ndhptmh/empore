<?php

use App\Http\Controllers\{AuthController, UserController, BookController};
use App\Http\Controllers\Admin\{MemberController,BookLoanController};
use App\Http\Controllers\Admin\BookController as Bukucontroller;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function() {
    Route::patch('/profile/{user}', [UserController::class, 'updateProfile']);
});


Route::get('/register', function(){
    return view('auth.register');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', function(){
    return view('welcome');
});

// Route::group(['middleware' => ['auth:admin']], function() {
//     Route::get('/users', [UserController::class, 'users']);
// });
Route::middleware('auth:admin')->group(function(){
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::resource('/member', MemberController::Class);
    Route::resource('/buku', BukuController::Class);
    Route::get('/peminjaman', [BookLoanController::class, 'index']);
    Route::get('/peminjaman/decline/{id}', [BookLoanController::class, 'decline']);
    Route::get('/peminjaman/accept/{id}', [BookLoanController::class, 'accept']);
    Route::get('/peminjaman/return/{id}', [BookLoanController::class, 'returned']);
    Route::get('/profile', [UserController::class, 'profile']);
});

// });
Route::middleware('auth:member')->prefix('/user')->group(function(){
    // Tulis routemu di sini.
    Route::resource('/buku', BookController::class);
    Route::get('/listBuku', [BookController::class, 'buku']);
    Route::get('/peminjaman', [BookController::class, 'loan']);
    Route::get('/bookloan', [BookController::class, 'bookloan']);
    Route::post('/bookloan/{id}', [BookController::class, 'storeBook']);
    Route::get('/profile', [UserController::class, 'profile']);
});