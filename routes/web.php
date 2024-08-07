<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'ideas/' , 'as' => 'ideas.', 'middleware' => ['auth']], function(){

    // save an idea
    Route::post('', [IdeaController::class, 'store'])->name('store')->withoutMiddleware('auth');

    // show one idea
    Route::get('/{idea}', [IdeaController::class, 'show'])->name('show')->withoutMiddleware('auth');

    // update one idea
    Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit');

    Route::put('/{idea}', [IdeaController::class, 'update'])->name('update');


    // delete idea
    Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('destroy');

    // create comment
    Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store');

});

// register
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);

// login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

// Logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/terms',function(){
    return view ('terms');
});



