<?php

use App\Livewire\DevelopersResource;
use App\Livewire\DevPickerFront;
use App\Livewire\UsersResource;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin|devpicker',
])->group(function () {
    Route::get('/', DevPickerFront::class)->name('home');
    Route::get('/developers', DevelopersResource::class)->name('developers');
    Route::get('/users', UsersResource::class)->name('users');
});
