<?php

namespace Motor\Revision\Grids;

use Motor\Backend\Grid\Grid;

/**
 * Class SponsorGrid
 * @package Motor\Revision\Grids
 */
class SponsorGrid extends Grid
{

    protected function setup()
    {
        $this->addColumn('id', 'ID', true);
        $this->setDefaultSorting('id', 'ASC');
        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.sponsors.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.sponsors.destroy');
    }
}
