<?php

use App\Livewire\DevelopersResource;
use App\Livewire\DevPickerFront;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', DevPickerFront::class)->name('home');
    Route::get('/developers', DevelopersResource::class)->name('developers');
});
