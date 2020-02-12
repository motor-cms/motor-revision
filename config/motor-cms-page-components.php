<?php

return [
    'groups'     => [
        'revision' => [
            'name' => 'Revision', // default groups are: basic, forms, media, navigation
        ],
    ],
    'components' => [
        'tickets'               => [
            'name'            => 'Ticket',
            'description'     => 'Show Ticket component',
            'view'            => 'motor-revision::frontend.components.tickets',
            'route'           => 'component.tickets',
            'component_class' => 'Motor\Revision\Components\ComponentTickets',
            'compatibility'   => [

            ],
            'permissions'     => [

            ],
            'group'           => 'revision'
        ],
        'shuttle-registrations' => [
            'name'            => 'ShuttleRegistration',
            'description'     => 'Show ShuttleRegistration component',
            'view'            => 'motor-revision::frontend.components.shuttle-registrations',
            'component_class' => 'Motor\Revision\Components\ComponentShuttleRegistrations',
            'compatibility'   => [

            ],
            'permissions'     => [

            ],
            'group'           => 'revision'
        ],
        'shuttle-lists'         => [
            'name'            => 'ShuttleList',
            'description'     => 'Show ShuttleList component',
            'view'            => 'motor-revision::frontend.components.shuttle-lists',
            'component_class' => 'Motor\Revision\Components\ComponentShuttleLists',
            'compatibility'   => [

            ],
            'permissions'     => [

            ],
            'group'           => 'revision'
        ],
    ],
];
