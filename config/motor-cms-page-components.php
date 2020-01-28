<?php

return [
    'groups'     => [
        'revision' => [
            'name' => 'Revision', // default groups are: basic, forms, media, navigation
        ],
    ],
    'components' => [
        'tickets' => [
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
    ],
];