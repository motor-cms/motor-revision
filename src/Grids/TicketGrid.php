<?php

namespace Motor\Revision\Grids;

use Motor\Backend\Grid\Grid;
use Motor\Backend\Grid\Renderers\BladeRenderer;
use Motor\Backend\Grid\Renderers\TranslateRenderer;

/**
 * Class TicketGrid
 * @package \Motor\Revision\Grids
 */
class TicketGrid extends Grid
{

    protected function setup()
    {
        $this->addColumn('type', trans('motor-revision::backend/tickets.type'))->renderer(TranslateRenderer::class,
            [ 'file' => 'motor-revision::backend/tickets.types' ]);
        $this->addColumn('handle', trans('motor-revision::backend/tickets.handle'));
        $this->addColumn('name', trans('motor-revision::backend/tickets.name'));
        $this->addColumn('shirt_size',
            trans('motor-revision::backend/tickets.shirt_size'))->renderer(TranslateRenderer::class,
            [ 'file' => 'motor-revision::backend/tickets.shirt_sizes' ]);
        $this->addColumn('amount',
            trans('motor-revision::backend/tickets.amount'));
        $this->addColumn('status', trans('motor-revision::backend/tickets.status'))->renderer(BladeRenderer::class,
            [ 'template' => 'motor-revision::grid.ticket_status', 'field' => 'status' ]
        );
        $this->setDefaultSorting('id', 'ASC');
        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.tickets.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.tickets.destroy');
    }
}
