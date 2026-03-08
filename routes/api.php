<?php

use Motor\Revision\Http\Controllers\Api\TicketsController;
use Motor\Revision\Http\Controllers\Api\AirportsController;
use Motor\Revision\Http\Controllers\Api\TravelersController;
use Motor\Revision\Http\Controllers\Api\ShuttlesController;
use Motor\Revision\Http\Controllers\Api\RidesController;
use Motor\Revision\Http\Controllers\Api\SponsorsController;
use Motor\Revision\Http\Controllers\Api\HotelsController;

Route::group([
    'middleware' => ['auth:api', 'bindings', 'permission'],
    'prefix'     => 'api',
    'as'         => 'api.',
], static function () {
    Route::apiResource('tickets', TicketsController::class);
    Route::apiResource('airports', AirportsController::class);
    Route::apiResource('travelers', TravelersController::class);
    Route::apiResource('shuttles', ShuttlesController::class);
    Route::apiResource('rides', RidesController::class);
    Route::apiResource('sponsors', SponsorsController::class);
    Route::apiResource('hotels', HotelsController::class);
});
