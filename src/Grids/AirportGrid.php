<?php

namespace Motor\Revision\Grids;

use Motor\Backend\Grid\Grid;
use Motor\Backend\Grid\Renderers\BooleanRenderer;

/**
 * Class AirportGrid
 *
 * @package Motor\Revision\Grids
 */
class AirportGrid extends Grid
{
    protected function setup()
    {
        $this->setDefaultSorting('sort_position', 'ASC');
        $this->addColumn('name', trans('motor-revision::backend/airports.name'));
        $this->addColumn('code', trans('motor-revision::backend/airports.code'));
        $this->addColumn('sort_position', trans('partymeister-competitions::backend/entries.sort_position_short'), true);
        $this->addColumn('is_active', trans('motor-revision::backend/airports.is_active'))
             ->renderer(BooleanRenderer::class);

        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.airports.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.airports.destroy');
    }
}
