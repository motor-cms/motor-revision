<?php

namespace Motor\Revision\Grids;

use Motor\Backend\Grid\Grid;
use Motor\Backend\Grid\Renderers\BladeRenderer;
use Motor\Backend\Grid\Renderers\BooleanRenderer;
use Motor\Backend\Grid\Renderers\TranslateRenderer;

/**
 * Class ShuttleGrid
 */
class ShuttleGrid extends Grid
{
    protected function setup()
    {
        $this->addColumn('is_active', trans('motor-revision::backend/shuttles.is_active'))
            ->renderer(BooleanRenderer::class);
        $this->setDefaultSorting('departs_at', 'ASC');
        $this->addColumn('name', trans('motor-revision::backend/shuttles.name'));
        $this->addColumn('airport.code', trans('motor-revision::backend/airports.code'));
        $this->addColumn('direction',
            trans('motor-revision::backend/shuttles.direction'))->renderer(TranslateRenderer::class,
                ['file' => 'motor-revision::backend/shuttles.directions']);
        $this->addColumn('times',
            trans('motor-revision::backend/shuttles.times'))
            ->renderer(
                BladeRenderer::class,
                ['template' => 'motor-revision::grid.shuttles.times']
            );
        $this->addColumn('seats',
            trans('motor-revision::backend/shuttles.seats'))
            ->renderer(
                BladeRenderer::class,
                ['template' => 'motor-revision::grid.shuttles.seats']
            );
        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.shuttles.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.shuttles.destroy');
    }
}
