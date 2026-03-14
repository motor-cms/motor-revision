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
                                                    ->with('airport')
                                                    ->get(),
            'toAirportWithoutShuttle'    => Traveler::toAirportWithoutShuttle()
                                                    ->with('airport')
                                                    ->get(),
            'toPartyWithShuttle'         => Traveler::toPartyWithShuttle()
                                                    ->with(['airport', 'shuttle'])
                                                    ->get(),
            'toAirportWithShuttle'       => Traveler::toAirportWithShuttle()
                                                    ->with(['airport', 'shuttle'])
                                                    ->get(),
            'confirmedShuttlesToParty'   => Shuttle::confirmedToParty()
                                                   ->with('airport')
                                                   ->get(),
            'confirmedShuttlesToAirport' => Shuttle::confirmedToAirport()
                                                   ->with('airport')
                                                   ->get(),
        ];

        return view(config('motor-cms-page-components.components.'.$this->pageVersionComponent->component_name.'.view'), $data);
    }
}
