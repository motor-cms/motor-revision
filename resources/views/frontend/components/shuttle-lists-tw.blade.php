@if ($toPartyWithoutShuttle->count() > 0)
    <div class="mb-8">
    <h3 class="mb-4">TO Revision without shuttle bus assigned</h3>
    @include('motor-revision::frontend.components.partials.traveler-list-without-shuttle-tw', ['travelers' => $toPartyWithoutShuttle])
    </div>
@endif

@if ($toAirportWithoutShuttle->count() > 0)
    <div class="mb-8">
    <h3 class="mb-4">FROM Revision without shuttle bus assigned</h3>
    @include('motor-revision::frontend.components.partials.traveler-list-without-shuttle-tw', ['travelers' => $toAirportWithoutShuttle])
    </div>
@endif

@if ($toPartyWithShuttle->count() > 0)
    <div class="mb-8">
    <h3 class="mb-4">TO Revision with shuttle bus assigned</h3>
    @include('motor-revision::frontend.components.partials.traveler-list-with-shuttle-tw', ['travelers' => $toPartyWithShuttle])
    </div>
@endif

@if ($toAirportWithShuttle->count() > 0)
    <div class="mb-8">
    <h3 class="mb-4">FROM Revision with shuttle bus assigned</h3>
    @include('motor-revision::frontend.components.partials.traveler-list-with-shuttle-tw', ['travelers' => $toAirportWithShuttle])
    </div>
@endif
@if ($confirmedShuttlesToParty->count() > 0)
    <div class="mb-8">
    <h3 class="mb-4">Confirmed shuttle buses TO Revision</h3>
    @include('motor-revision::frontend.components.partials.shuttle-list-tw', ['shuttles' => $confirmedShuttlesToParty])
    </div>
@endif

@if ($confirmedShuttlesToAirport->count() > 0)
    <div class="mb-8 last:mb-0">
    <h3 class="mb-4">Confirmed shuttle buses FROM Revision</h3>
    @include('motor-revision::frontend.components.partials.shuttle-list-tw', ['shuttles' => $confirmedShuttlesToAirport])
    </div>
@endif
