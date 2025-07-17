<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\PortfolioController;
use App\Models\Carrier;

Route::get('/', function() {
    return view('index', [
        'carriers' => Carrier::all()
    ]);
});

Route::namespace('App\Http\Controllers\Dashboard')->prefix('dashboard')->name('dashboard.')->group(function() {
    Route::resource('/carrier', 'CarrierController');
    Route::resource('/carrier/{carrier}/portfolio', 'PortfolioController');
});

Route::get('/download/{path}', [PortfolioController::class, 'download'])->where('path', '.*')->name('download');