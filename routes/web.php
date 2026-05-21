<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicationNoteController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\TodoCommentController;
use App\Http\Controllers\TodoController;

Route::get('/', [HomepageController::class, 'home'])->name('home');

Route::prefix('todos')
    ->name('todos.')
    ->group(function () {
        Route::get('/', [TodoController::class, 'index'])->name('index');
        Route::post('/', [TodoController::class, 'store'])->name('store');
        Route::get('/create', [TodoController::class, 'create'])->name('create');

        Route::prefix('{todo}')->group(function () {
            Route::get('/', [TodoController::class, 'show'])->name('show');
            Route::put('/', [TodoController::class, 'update'])->name('update');
            Route::delete('/', [TodoController::class, 'destroy'])->name('destroy');
            Route::get('/edit', [TodoController::class, 'edit'])->name('edit');
            Route::patch('/toggle', [TodoController::class, 'toggle'])->name('toggle');

            Route::prefix('comments')->name('comments.')->group(function () {
                Route::post('/', [TodoCommentController::class, 'store'])->name('store');
                Route::delete('/{comment}', [TodoCommentController::class, 'destroy'])->name('destroy');
            });
        });
    });

