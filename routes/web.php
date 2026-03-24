<?php

use Illuminate\Support\Facades\Route;
use Prezet\Prezet\Http\Controllers\IndexController;
use Prezet\Prezet\Http\Controllers\ShowController;
use Prezet\Prezet\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('prezet')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('prezet.index');
    Route::get('img/{path}', [ImageController::class, 'show'])->where('path', '.*')->name('prezet.image');
    Route::get('{slug}', [ShowController::class, 'show'])->where('slug', '.*')->name('prezet.show');
});
require __DIR__.'/prezet.php';