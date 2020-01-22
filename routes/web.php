<?php
Route::group([
    'as'         => 'backend.',
    'prefix'     => 'backend',
    'namespace'  => 'Motor\Revision\Http\Controllers\Backend',
    'middleware' => [
        'web',
        'web_auth',
        'navigation'
    ]
], static function () {
    Route::resource('tickets', 'TicketsController');
    Route::resource('airports', 'AirportsController');
    Route::resource('travelers', 'TravelersController');
    Route::resource('shuttles', 'ShuttlesController');
    Route::resource('rides', 'RidesController');
    Route::resource('sponsors', 'SponsorsController');
    Route::resource('hotels', 'HotelsController');
});
