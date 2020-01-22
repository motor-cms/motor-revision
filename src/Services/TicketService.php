<?php

namespace Motor\Revision\Services;

use Motor\Backend\Services\BaseService;
use \Motor\Revision\Models\Ticket;

/**
 * Class TicketService
 * @package \Motor\Revision\Services
 */
class TicketService extends BaseService
{

    protected $model = Ticket::class;
}
