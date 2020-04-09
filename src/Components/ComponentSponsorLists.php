<?php

namespace Motor\Revision\Components;

use Illuminate\Http\Request;
use Motor\CMS\Models\PageVersionComponent;
use Motor\Revision\Models\Sponsor;

class ComponentSponsorLists {

    protected $pageVersionComponent;
    protected $sponsors;

    public function __construct(PageVersionComponent $pageVersionComponent)
    {
        $this->pageVersionComponent = $pageVersionComponent;
    }

    public function index(Request $request)
    {
        $this->sponsors = Sponsor::where('is_active', true)->orderBy('level', 'ASC')->orderBy('sort_position', 'ASC')->get();
        return $this->render();
    }

    public function render()
    {
        return view(config('motor-cms-page-components.components.'.$this->pageVersionComponent->component_name.'.view'), ['sponsors' => $this->sponsors]);
    }

}
