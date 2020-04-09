<?php

namespace Motor\Revision\Components;

use Illuminate\Http\Request;
use Motor\CMS\Models\PageVersionComponent;

class ComponentSponsorFooters {

    protected $pageVersionComponent;

    public function __construct(PageVersionComponent $pageVersionComponent)
    {
        $this->pageVersionComponent = $pageVersionComponent;
    }

    public function index(Request $request)
    {
        return $this->render();
    }

    public function render()
    {
        return view(config('motor-cms-page-components.components.'.$this->pageVersionComponent->component_name.'.view'), []);
    }

}
