<?php

return [
    'items' => [
        5 => [
            'slug'        => 'revision',
            'name'        => 'motor-revision::backend/global.revision',
            'icon'        => 'fa fa-home',
            'route'       => null,
            'roles'       => [ 'SuperAdmin' ],
            'permissions' => [ 'revision.read' ],
            'items'       => [
                100 => [
                    'slug'        => 'tickets',
                    'name'        => 'motor-revision::backend/tickets.tickets',
                    'icon'        => 'fa fa-plus',
                    'route'       => 'backend.tickets.index',
                    'roles'       => [ 'SuperAdmin' ],
                    'permissions' => [ 'tickets.read' ],
                ],
                200 => [ // <-- !!! replace 531 with your own sort position !!!
                         'slug'        => 'airports',
                         'name'        => 'motor-revision::backend/airports.airports',
                         'icon'        => 'fa fa-plus',
                         'route'       => 'backend.airports.index',
                         'roles'       => [ 'SuperAdmin' ],
                         'permissions' => [ 'airports.read' ],
                ],
                300 => [ // <-- !!! replace 341 with your own sort position !!!
                         'slug'        => 'travelers',
                         'name'        => 'motor-revision::backend/travelers.travelers',
                         'icon'        => 'fa fa-plus',
                         'route'       => 'backend.travelers.index',
                         'roles'       => [ 'SuperAdmin' ],
                         'permissions' => [ 'travelers.read' ],
                ],
                400 => [ // <-- !!! replace 165 with your own sort position !!!
                         'slug'        => 'shuttles',
                         'name'        => 'motor-revision::backend/shuttles.shuttles',
                         'icon'        => 'fa fa-plus',
                         'route'       => 'backend.shuttles.index',
                         'roles'       => [ 'SuperAdmin' ],
                         'permissions' => [ 'shuttles.read' ],
                ],
                500 => [ // <-- !!! replace 187 with your own sort position !!!
                         'slug'        => 'rides',
                         'name'        => 'motor\revision::backend/rides.rides',
                         'icon'        => 'fa fa-plus',
                         'route'       => 'backend.rides.index',
                         'roles'       => [ 'SuperAdmin' ],
                         'permissions' => [ 'rides.read' ],
                ],
                600 => [ // <-- !!! replace 371 with your own sort position !!!
                         'slug'        => 'sponsors',
                         'name'        => 'motor\revision::backend/sponsors.sponsors',
                         'icon'        => 'fa fa-plus',
                         'route'       => 'backend.sponsors.index',
                         'roles'       => [ 'SuperAdmin' ],
                         'permissions' => [ 'sponsors.read' ],
                ],
                700 => [ // <-- !!! replace 290 with your own sort position !!!
                         'slug'        => 'hotels',
                         'name'        => 'motor\revision::backend/hotels.hotels',
                         'icon'        => 'fa fa-plus',
                         'route'       => 'backend.hotels.index',
                         'roles'       => [ 'SuperAdmin' ],
                         'permissions' => [ 'hotels.read' ],
                ],
            ]
        ],
    ]
];
