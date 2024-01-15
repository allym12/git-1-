<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us',[HomeController::class,'about'])->name('about-page');
Route::get('/terms',[HomeController::class,'terms'])->name('terms-page');
Route::get('/contact',[HomeController::class,'contact'])->name('contact-page');
Route::get('/footer',[HomeController::class,'footer'])->name('footer-page');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

//    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/houses/{house:slug}', [\App\Http\Controllers\HouseController::class, 'show'])->name('houses.show');
Route::get('/houses', \App\Http\Livewire\HouseListingComponent::class)->name('houses.index');

Route::get('/cars/{car:slug}', [\App\Http\Controllers\CarController::class, 'show'])->name('cars.show');
Route::get('/cars', [\App\Http\Controllers\CarController::class, 'index'])->name('cars.index');

Route::get('/lands/{land:slug}', [\App\Http\Controllers\LandController::class, 'show'])->name('lands.show');
Route::get('/lands', [\App\Http\Controllers\LandController::class, 'index'])->name('lands.index');

Route::get('/hotels/{hotel:slug}', [\App\Http\Controllers\HotelController::class, 'show'])->name('hotels.show');
Route::get('/hotels', [\App\Http\Controllers\HotelController::class, 'index'])->name('hotels.index');


Route::get('/fashions/{fashion:slug}', [\App\Http\Controllers\FashionController::class, 'show'])->name('fashions.show');
Route::get('/fashions', [\App\Http\Controllers\FashionController::class, 'index'])->name('fashions.index');

Route::get('check_transaction', [\App\Http\Controllers\PaymentController::class, 'check_transaction'])->name('check_transaction');


Route::get('choices', function () {
    return view('choices');
})->name('choices');

require __DIR__.'/auth.php';
