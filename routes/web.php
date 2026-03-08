<?php

use Motor\Revision\Http\Controllers\Backend\TicketsController;
use Motor\Revision\Http\Controllers\Backend\AirportsController;
use Motor\Revision\Http\Controllers\Backend\TravelersController;
use Motor\Revision\Http\Controllers\Backend\ShuttlesController;
use Motor\Revision\Http\Controllers\Backend\RidesController;
use Motor\Revision\Http\Controllers\Backend\SponsorsController;
use Motor\Revision\Http\Controllers\Backend\HotelsController;
use Motor\Revision\Http\Controllers\Backend\Component\ComponentTicketsController;

Route::group([
    'as'         => 'backend.',
    'prefix'     => 'backend',
    'middleware' => [
        'web',
        'web_auth',
        'navigation',
    ],
], static function () {
    Route::resource('tickets', TicketsController::class);
    Route::resource('airports', AirportsController::class);
    Route::resource('travelers', TravelersController::class);
    Route::resource('shuttles', ShuttlesController::class);
    Route::resource('rides', RidesController::class);
    Route::resource('sponsors', SponsorsController::class);
    Route::resource('hotels', HotelsController::class);
});

// Only add the route group if you don't already have one for the given namespace
Route::group([
    'as'         => 'component.',
    'prefix'     => 'component',
    'middleware' => [
        'web',
    ],
], function () {
    // You only need this part if you already have a component group for the given namespace
    Route::get('tickets', [ComponentTicketsController::class, 'create'])
         ->name('tickets.create');
    Route::post('tickets', [ComponentTicketsController::class, 'store'])
         ->name('tickets.store');
    Route::get('tickets/{component_ticket}', [ComponentTicketsController::class, 'edit'])
         ->name('tickets.edit');
    Route::patch('tickets/{component_ticket}', [ComponentTicketsController::class, 'update'])
         ->name('tickets.update');
});
