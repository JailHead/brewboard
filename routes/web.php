<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EmployeeAccess;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

Route::middleware(['auth', EmployeeAccess::class])->group(function () {
    Route::get('/barista', function () {
        return view('barista.dashboard');
    })->middleware(EmployeeAccess::class . ':Barista')->name('barista.dashboard');

    Route::get('/preparador', function () {
        return view('preparador.dashboard');
    })->middleware(EmployeeAccess::class . ':Preparador')->name('preparador.dashboard');
});