<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[App\Http\Controllers\BarcodeController::class, 'Index'])->name('index');

Route::get('/app', function () {
    return view('app');
});

Route::any('/newProduct', [App\Http\Controllers\BarcodeController::class, 'NewProduct'])->name('newProduct');


Route::get('/barcode', [App\Http\Controllers\BarcodeController::class, 'Barcode'])->name('Barcode');

Route::post('/GenerateBarcode', [App\Http\Controllers\BarcodeController::class, 'GenerateBarcode'])->name('GenerateBarcode');

