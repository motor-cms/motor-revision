<?php
Route::group([
    'middleware' => [ 'auth:api', 'bindings', 'permission' ],
    'namespace'  => 'Motor\Revision\Http\Controllers\Api',
    'prefix'     => 'api',
    'as'         => 'api.',
], static function () {
    Route::resource('tickets', 'TicketsController');
    Route::resource('airports', 'AirportsController');
    Route::resource('travelers', 'TravelersController');
    Route::resource('shuttles', 'ShuttlesController');
    Route::resource('rides', 'RidesController');
    Route::resource('sponsors', 'SponsorsController');
    Route::resource('hotels', 'HotelsController');
});

Route::group([
    'middleware' => [ 'web', 'web_auth', 'bindings', 'permission' ],
    'namespace'  => 'Motor\Revision\Http\Controllers\Api',
    'prefix'     => 'ajax',
    'as'         => 'ajax.',
], static function () {
});
