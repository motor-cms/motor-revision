<?php

namespace Motor\Revision\Grids;

use Motor\Backend\Grid\Grid;

/**
 * Class HotelGrid
 * @package Motor\Revision\Grids
 */
class HotelGrid extends Grid
{

    protected function setup()
    {
        $this->addColumn('id', 'ID', true);
        $this->setDefaultSorting('id', 'ASC');
        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.hotels.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.hotels.destroy');
    }
}
