<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/widget', [TicketController::class, 'create'])->name('widget');

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('main');
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
Route::patch('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update-status');
