<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);

//пользователи
Route::get('users', [UserController::class, 'index']);
Route::post('users/create', [UserController::class, 'create']);

//места для отдыха
Route::get('places', [PlaceController::class, 'index']);
Route::post('places/create', [PlaceController::class, 'create']);

//список желаемого
Route::post('wishlists/create', [WishlistController::class, 'create']);
Route::get('wishlists/{id}', [WishlistController::class, 'index', ]);
