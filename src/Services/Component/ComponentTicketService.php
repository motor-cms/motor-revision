<?php

namespace Motor\Revision\Services\Component;

use Motor\CMS\Services\ComponentBaseService;
use Motor\Revision\Models\Component\ComponentTicket;

class ComponentTicketService extends ComponentBaseService
{
    protected $model = ComponentTicket::class;

    protected $name = 'tickets';
}
