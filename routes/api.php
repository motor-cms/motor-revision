<?php
Route::group([
    'middleware' => ['auth:api', 'bindings', 'permission'],
    'namespace'  => 'Motor\Revision\Http\Controllers\Api',
    'prefix'     => 'api',
    'as'         => 'api.',
], static function () {
    Route::apiResource('tickets', 'TicketsController');
    Route::apiResource('airports', 'AirportsController');
    Route::apiResource('travelers', 'TravelersController');
    Route::apiResource('shuttles', 'ShuttlesController');
    Route::apiResource('rides', 'RidesController');
    Route::apiResource('sponsors', 'SponsorsController');
    Route::apiResource('hotels', 'HotelsController');
});
