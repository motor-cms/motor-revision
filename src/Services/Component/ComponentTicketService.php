<?php

namespace Motor\Revision\Services\Component;

use Motor\Revision\Models\Component\ComponentTicket;
use Motor\CMS\Services\ComponentBaseService;

class ComponentTicketService extends ComponentBaseService
{

    protected $model = ComponentTicket::class;

    protected $name = 'tickets';
}
