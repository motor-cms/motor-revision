<?php

namespace Motor\Revision\Grids;

use Motor\Backend\Grid\Grid;

/**
 * Class ShuttleGrid
 * @package Motor\Revision\Grids
 */
class ShuttleGrid extends Grid
{

    protected function setup()
    {
        $this->addColumn('id', 'ID', true);
        $this->setDefaultSorting('id', 'ASC');
        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.shuttles.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.shuttles.destroy');
    }
}
