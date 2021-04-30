<?php

namespace Motor\Revision\Components;

use Illuminate\Http\Request;
use Motor\CMS\Models\PageVersionComponent;
use Motor\Revision\Models\Shuttle;
use Motor\Revision\Models\Traveler;

class ComponentShuttleLists
{
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
        $data = [
            'toPartyWithoutShuttle'      => Traveler::toPartyWithoutShuttle()
                                                    ->get(),
            'toAirportWithoutShuttle'    => Traveler::toAirportWithoutShuttle()
                                                    ->get(),
            'toPartyWithShuttle'         => Traveler::toPartyWithShuttle()
                                                    ->get(),
            'toAirportWithShuttle'       => Traveler::toAirportWithShuttle()
                                                    ->get(),
            'confirmedShuttlesToParty'   => Shuttle::confirmedToParty()
                                                   ->get(),
            'confirmedShuttlesToAirport' => Shuttle::confirmedToAirport()
                                                   ->get(),
        ];

        return view(config('motor-cms-page-components.components.'.$this->pageVersionComponent->component_name.'.view'), $data);
    }
}
