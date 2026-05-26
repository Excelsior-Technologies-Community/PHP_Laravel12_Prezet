<?php

use Illuminate\Support\Facades\Route;

use Prezet\Prezet\Http\Controllers\IndexController;
use Prezet\Prezet\Http\Controllers\ImageController;

use App\Http\Controllers\Prezet\ShowController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


// SEARCH ROUTE
Route::get('/search', [SearchController::class, 'search'])
    ->name('search');


// LIKE ROUTE
Route::post('/like/store', [LikeController::class, 'store'])
    ->name('like.store');


// PREZET BLOG ROUTES
Route::prefix('prezet')->group(function () {

    // BLOG HOME
    Route::get('/', [IndexController::class, 'index'])
        ->name('prezet.index');

    // IMAGE ROUTE
    Route::get('img/{path}', [ImageController::class, 'show'])
        ->where('path', '.*')
        ->name('prezet.image');

    // SINGLE POST
    Route::get('{slug}', [ShowController::class, 'show'])
        ->where('slug', '.*')
        ->name('prezet.show');
});

require __DIR__.'/prezet.php';