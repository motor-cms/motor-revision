<?php

namespace Motor\Revision\Services;

use Illuminate\Support\Arr;
use Motor\Backend\Services\BaseService;
use Motor\Core\Filter\Renderers\SelectRenderer;
use \Motor\Revision\Models\Ticket;
use Partymeister\Competitions\Models\Competition;

/**
 * Class TicketService
 * @package \Motor\Revision\Services
 */
class TicketService extends BaseService
{

    protected $model = Ticket::class;

    public function filters()
    {
        $this->filter->add(new SelectRenderer('type'))
            ->setOptionPrefix(trans('motor-revision::backend/tickets.type'))
            ->setEmptyOption('-- ' . trans('motor-revision::backend/tickets.type') . ' --')
            ->setOptions(trans('motor-revision::backend/tickets.types'));
    }

    public function beforeCreate()
    {
        $this->mergeData();
    }

    public function beforeUpdate()
    {
        $this->mergeData();
    }

    private function mergeData()
    {
        switch ($this->request->get('type')) {
            case 'at_home':
                $this->data = array_merge($this->data, $this->data['at_home']);
                break;
            case 'subsidized':
                $this->data = array_merge($this->data, $this->data['subsidized']);
                break;
            case 'supporter':
                $this->data = array_merge($this->data, $this->data['supporter']);
                break;
        }
    }
}
