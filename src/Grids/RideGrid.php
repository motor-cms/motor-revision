<?php

namespace Motor\Revision\Grids;

use Motor\Backend\Grid\Grid;

/**
 * Class RideGrid
 *
 * @package Motor\Revision\Grids
 */
class RideGrid extends Grid
{
    protected function setup()
    {
        $this->addColumn('id', 'ID', true);
        $this->setDefaultSorting('id', 'ASC');
        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.rides.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.rides.destroy');
    }
}
