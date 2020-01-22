<?php

namespace Motor\Revision\Grids;

use Motor\Backend\Grid\Grid;

/**
 * Class AirportGrid
 * @package Motor\Revision\Grids
 */
class AirportGrid extends Grid
{

    protected function setup()
    {
        $this->addColumn('id', 'ID', true);
        $this->setDefaultSorting('id', 'ASC');
        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.airports.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.airports.destroy');
    }
}
