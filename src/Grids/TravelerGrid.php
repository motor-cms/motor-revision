<?php

namespace Motor\Revision\Grids;

use Motor\Backend\Grid\Grid;

/**
 * Class TravelerGrid
 * @package Motor\Revision\Grids
 */
class TravelerGrid extends Grid
{

    protected function setup()
    {
        $this->addColumn('id', 'ID', true);
        $this->setDefaultSorting('id', 'ASC');
        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.travelers.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.travelers.destroy');
    }
}
