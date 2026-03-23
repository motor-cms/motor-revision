<?php

namespace Motor\Revision\Grids;

use Motor\Admin\Grid\Grid;
use Motor\Admin\Grid\Renderers\BladeRenderer;
use Motor\Admin\Grid\Renderers\TranslateRenderer;

/**
 * Class TicketGrid
 *
 * @package \Motor\Revision\Grids
 */
class TicketGrid extends Grid
{
    protected function setup()
    {
        $this->addColumn('type', trans('motor-revision::backend/tickets.type'))
             ->renderer(TranslateRenderer::class, ['file' => 'motor-revision::backend/tickets.types']);
        $this->addColumn('handle', trans('motor-revision::backend/tickets.handle'));
        $this->addColumn('name', trans('motor-revision::backend/tickets.name'));
        $this->addColumn('shirt_size', trans('motor-revision::backend/tickets.shirt_size'))
             ->renderer(TranslateRenderer::class, ['file' => 'motor-revision::backend/tickets.shirt_sizes']);
        $this->addColumn('amount', trans('motor-revision::backend/tickets.amount'));
        $this->addColumn('status', trans('motor-revision::backend/tickets.status'))
             ->renderer(BladeRenderer::class, [
                     'template' => 'motor-revision::grid.ticket_status',
                     'field'    => 'status',
                 ]);
        $this->setDefaultSorting('id', 'ASC');
        $this->addEditAction(trans('motor-admin::backend/global.edit'), 'backend.tickets.edit');
        $this->addDeleteAction(trans('motor-admin::backend/global.delete'), 'backend.tickets.destroy');
    }
}
