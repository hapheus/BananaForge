<?php

use App\Http\Controllers\GenerationImageIndexController;
use App\Http\Controllers\GenerationStoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/generations', GenerationStoreController::class)->name('generations.store');
Route::get('/generations/{generationId}/images', GenerationImageIndexController::class)->name('generations.images.index');
