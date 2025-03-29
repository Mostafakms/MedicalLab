<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\OrderController;


Route::resource('patients', PatientController::class);
Route::resource('tests', TestController::class);
Route::resource('orders', OrderController::class);


Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', function () {
    return view('home');
});


Route::get('/layout', function () {
    return view('layout');
});

Route::get('/orders/{order}/results', [OrderController::class, 'showResultsForm'])
    ->name('orders.results');

Route::post('/orders/{order}/results', [OrderController::class, 'saveResults'])
    ->name('orders.saveResults');

Route::get('/orders/{orderId}/stool-report/{orderDetailId}', [OrderController::class, 'showStoolReportForm'])->name('orders.enterStoolReport');
Route::post('/orders/{orderId}/stool-report/{orderDetailId}', [OrderController::class, 'saveStoolReport'])->name('orders.saveStoolReport');
    
Route::get('/orders/{order}/print', [OrderController::class, 'print'])->name('orders.print');
Route::get('/orders/{order}/pdf', [OrderController::class, 'generateOrderPdf'])->name('orders.generatePdf');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
});

require __DIR__.'/auth.php';
