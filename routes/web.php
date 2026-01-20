<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Registro
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout']);

// Dashboard para cualquier usuario logueado
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth');

// Dashboard solo para admin, usando tu AdminMiddleware
Route::get('/admin', function () {
    $middleware = new AdminMiddleware();
    return $middleware->handle(request(), function ($request) {
        $controller = new DashboardController();
        return $controller->index();
    });
});