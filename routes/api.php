<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Cars\CarController;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\Cars\CarPriceController;
use App\Http\Controllers\Review\ReviewController;
use App\Http\Controllers\Basket\CheckoutController;
use App\Http\Controllers\Review\CarReviewController;
use App\Http\Controllers\Cars\CarAvailabilityController;
use App\Http\Controllers\Cars\CarBookingController;
use App\Http\Controllers\Review\CarBookingByReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logut');

    Route::get('user-details', [UsersController::class, 'getUserDetails'])->name('api.user-details')->middleware('can:view-developer-dashboard');

    Route::put('change-password', [UsersController::class, 'changePassword'])->name('api.change-password');
    Route::put('change-details', [UsersController::class, 'changeDetails'])->name('api.change-details');

    Route::apiResource('cars', CarController::class)->only('index', 'show');
    Route::get('cars/{car}/availability', CarAvailabilityController::class)->name('cars.availability.show');
    Route::get('cars/{car}/reviews', CarReviewController::class)->name('cars.reviews.index');

    Route::apiResource('reviews', ReviewController::class)->only('show', 'store');
    Route::get('car-booking-by-review/{reviewKey}', CarBookingByReviewController::class)->name('carBooking.by-review.show');
    Route::get('cars/{car}/price', CarPriceController::class)->name('car.price.show');
    Route::post('checkout', CheckoutController::class)->name('checkout');
});

Route::post('login', [AuthController::class, 'login'])->name('api.login');
Route::post('register', [AuthController::class, 'register'])->name('api.register');
Route::get('constants', [ConstantsController::class, 'index'])->name('api.constans');
Route::get('bookings/{user}', [CarBookingController::class, 'getUserBookings'])->name('api.bookings');

