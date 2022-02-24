<?php

use App\Models\User;
use App\Models\Category;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardCommentsController;

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
    return view('home', [
        'title' => 'Home'
    ]);
});

Route::get('/blog', [PostController::class, 'index']);
Route::get('/blog/{post:slug}', [PostController::class, 'show']);
Route::post('/blog/{post:slug}/comments', [PostController::class, 'storeComment']);

Route::get('/categories', function() {
    return view('lists', [
        'title' => 'Categories',
        'data' => Category::all()
    ]);
});
Route::get('/categories/{category:slug}', function (Category $category) {
    return view('blog', [
        'title' => "Post by Category: $category->name",
        'data' => $category->posts()->paginate(10)
    ]);
});

Route::get('/authors', function() {
    return view('lists', [
        'title' => 'Authors',
        'data' => User::all()
    ]);
});
Route::get('/authors/{user:username}', function(User $user) {
    return view('blog', [
        'title' => "Post By Author: $user->name",
        'data' => $user->posts()->paginate(10)
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function() {
    return view('dashboard.index', [
        'title' => 'Dashboard'
    ]);
})->middleware('auth');

Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::resource('/dashboard/comments', DashboardCommentsController::class)->middleware('auth');