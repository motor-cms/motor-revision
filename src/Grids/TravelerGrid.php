<?php

namespace Motor\Revision\Grids;

use Motor\Backend\Grid\Grid;
use Motor\Backend\Grid\Renderers\DateRenderer;
use Motor\Backend\Grid\Renderers\TranslateRenderer;

/**
 * Class TravelerGrid
 * @package Motor\Revision\Grids
 */
class TravelerGrid extends Grid
{

    protected function setup()
    {
        $this->addColumn('name', trans('motor-revision::backend/travelers.name'), true);
        $this->addColumn('number_of_people', 'P');
        $this->addColumn('mobile_phone', trans('motor-revision::backend/travelers.mobile'));
        $this->addColumn('flight_time', trans('motor-revision::backend/travelers.flight_time'))->renderer(DateRenderer::class);
        $this->addColumn('airport.code', trans('motor-revision::backend/airports.airport'));
        $this->addColumn('flight_number', trans('motor-revision::backend/travelers.flight'));
        $this->addColumn('direction',
            trans('motor-revision::backend/shuttles.direction'))->renderer(TranslateRenderer::class,
            [ 'file' => 'motor-revision::backend/shuttles.directions' ]);
        $this->addColumn('shuttle.name', trans('motor-revision::backend/shuttles.shuttle'));

        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.travelers.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.travelers.destroy');
    }
}
