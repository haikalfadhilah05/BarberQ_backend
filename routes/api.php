<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\LayananController;

// AUTH
Route::post('/register', [
    AuthController::class,
    'register'
]);

Route::post('/login', [
    AuthController::class,
    'login'
]);

// PROTECTED LOGIN
Route::middleware(
    'auth:sanctum'
)->group(function () {

    Route::get('/me', [
        AuthController::class,
        'me'
    ]);

    Route::post('/logout', [
        AuthController::class,
        'logout'
    ]);

    // BOOKING
    Route::apiResource(
        'bookings',
        BookingController::class
    );

    // USER BOLEH LIHAT
    Route::get(
        '/barbers',
        [
            BarberController::class,
            'index'
        ]
    );

    Route::get(
        '/layanans',
        [
            LayananController::class,
            'index'
        ]
    );

    // ADMIN ONLY
    Route::middleware(
        'role:admin'
    )->group(function () {

        Route::post(
            '/barbers',
            [
                BarberController::class,
                'store'
            ]
        );

        Route::put(
            '/barbers/{barber}',
            [
                BarberController::class,
                'update'
            ]
        );

        Route::delete(
            '/barbers/{barber}',
            [
                BarberController::class,
                'destroy'
            ]
        );

        Route::post(
            '/layanans',
            [
                LayananController::class,
                'store'
            ]
        );

        Route::put(
            '/layanans/{layanan}',
            [
                LayananController::class,
                'update'
            ]
        );

        Route::delete(
            '/layanans/{layanan}',
            [
                LayananController::class,
                'destroy'
            ]
        );
    });
});
