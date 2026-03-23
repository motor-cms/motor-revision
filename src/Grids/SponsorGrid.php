<?php

namespace Motor\Revision\Grids;

use Motor\Admin\Grid\Grid;
use Motor\Admin\Grid\Renderers\BooleanRenderer;
use Motor\Admin\Grid\Renderers\TranslateRenderer;

/**
 * Class SponsorGrid
 *
 * @package Motor\Revision\Grids
 */
class SponsorGrid extends Grid
{
    protected function setup()
    {
        $this->setDefaultSorting('level', 'DESC');
        $this->addColumn('name', trans('motor-revision::backend/sponsors.name'));
        $this->addColumn('level', trans('motor-revision::backend/sponsors.level'))
             ->renderer(TranslateRenderer::class, ['file' => 'motor-revision::backend/sponsors.levels']);
        $this->addColumn('sort_position', trans('motor-revision::backend/sponsors.sort_position'));
        $this->addColumn('is_active', trans('motor-revision::backend/sponsors.is_active'))
             ->renderer(BooleanRenderer::class);
        $this->addEditAction(trans('motor-admin::backend/global.edit'), 'backend.sponsors.edit');
        $this->addDeleteAction(trans('motor-admin::backend/global.delete'), 'backend.sponsors.destroy');
    }
}
