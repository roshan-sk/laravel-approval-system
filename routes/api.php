<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RequestController;

Route::post('/users', [UserController::class, 'create']);

Route::post('/requests', [RequestController::class, 'create']);
Route::get('/requests/{id}/approve', [RequestController::class, 'approve']);
Route::get('/requests/{id}/reject', [RequestController::class, 'reject']);
Route::get('/requests', [RequestController::class, 'index']);
Route::get('/requests/{id}', [RequestController::class, 'show']);