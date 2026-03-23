<?php

namespace Motor\Revision\Grids;

use Motor\Admin\Grid\Grid;

/**
 * Class HotelGrid
 *
 * @package Motor\Revision\Grids
 */
class HotelGrid extends Grid
{
    protected function setup()
    {
        $this->addColumn('id', 'ID', true);
        $this->setDefaultSorting('id', 'ASC');
        $this->addEditAction(trans('motor-admin::backend/global.edit'), 'backend.hotels.edit');
        $this->addDeleteAction(trans('motor-admin::backend/global.delete'), 'backend.hotels.destroy');
    }
}
