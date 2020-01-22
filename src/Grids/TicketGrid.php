<?php

namespace Motor\Revision\Grids;

use Motor\Backend\Grid\Grid;

/**
 * Class TicketGrid
 * @package \Motor\Revision\Grids
 */
class TicketGrid extends Grid
{

    protected function setup()
    {
        $this->addColumn('id', 'ID', true);
        $this->setDefaultSorting('id', 'ASC');
        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.tickets.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.tickets.destroy');
    }
}
