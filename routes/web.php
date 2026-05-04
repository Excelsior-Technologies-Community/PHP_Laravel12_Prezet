<?php

use Illuminate\Support\Facades\Route;
use Prezet\Prezet\Http\Controllers\IndexController;
use App\Http\Controllers\Prezet\ShowController;
use Prezet\Prezet\Http\Controllers\ImageController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('prezet')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('prezet.index');
    Route::get('img/{path}', [ImageController::class, 'show'])->where('path', '.*')->name('prezet.image');
    Route::get('{slug}', [ShowController::class, 'show'])->where('slug', '.*')->name('prezet.show');
});

Route::get('/prezet/{slug}', ShowController::class)->name('prezet.show');

require __DIR__.'/prezet.php';