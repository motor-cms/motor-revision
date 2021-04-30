<?php
Route::group([
    'as'         => 'backend.',
    'prefix'     => 'backend',
    'namespace'  => 'Motor\Revision\Http\Controllers\Backend',
    'middleware' => [
        'web',
        'web_auth',
        'navigation',
    ],
], static function () {
    Route::resource('tickets', 'TicketsController');
    Route::resource('airports', 'AirportsController');
    Route::resource('travelers', 'TravelersController');
    Route::resource('shuttles', 'ShuttlesController');
    Route::resource('rides', 'RidesController');
    Route::resource('sponsors', 'SponsorsController');
    Route::resource('hotels', 'HotelsController');
});

// Only add the route group if you don't already have one for the given namespace
Route::group([
    'as'         => 'component.',
    'prefix'     => 'component',
    'namespace'  => 'Motor\Revision\Http\Controllers\Backend\Component',
    'middleware' => [
        'web',
    ],
], function () {
    // You only need this part if you already have a component group for the given namespace
    Route::get('tickets', 'ComponentTicketsController@create')
         ->name('tickets.create');
    Route::post('tickets', 'ComponentTicketsController@store')
         ->name('tickets.store');
    Route::get('tickets/{component_ticket}', 'ComponentTicketsController@edit')
         ->name('tickets.edit');
    Route::patch('tickets/{component_ticket}', 'ComponentTicketsController@update')
         ->name('tickets.update');
});
