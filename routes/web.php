<?php

use App\Livewire\DevPickerFront;
use App\Livewire\GitHubApi;
use Illuminate\Support\Facades\Route;

Route::get('/', DevPickerFront::class)->name('home');
Route::get('/giithub', GitHubApi::class)->name('github');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
