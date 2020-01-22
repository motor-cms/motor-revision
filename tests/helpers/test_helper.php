<?php

function create_test_ticket($count = 1)
{
    return factory(\Motor\Revision\Models\Ticket::class, $count)->create();
}

function create_test_airport($count = 1)
{
    return factory(Motor\Revision\Models\Airport::class, $count)->create();
}

function create_test_traveler($count = 1)
{
    return factory(Motor\Revision\Models\Traveler::class, $count)->create();
}

function create_test_shuttle($count = 1)
{
    return factory(Motor\Revision\Models\Shuttle::class, $count)->create();
}

function create_test_ride($count = 1)
{
    return factory(Motor\Revision\Models\Ride::class, $count)->create();
}

function create_test_sponsor($count = 1)
{
    return factory(Motor\Revision\Models\Sponsor::class, $count)->create();
}

function create_test_hotel($count = 1)
{
    return factory(Motor\Revision\Models\Hotel::class, $count)->create();
}
