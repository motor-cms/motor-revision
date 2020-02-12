@if ($toPartyWithoutShuttle->count() > 0)
    <h3>TO Revision without shuttle bus assigned</h3>
    @include('motor-revision::frontend.components.partials.traveler-list-without-shuttle', ['travelers' => $toPartyWithoutShuttle])
@endif

@if ($toAirportWithoutShuttle->count() > 0)
    <h3>FROM Revision without shuttle bus assigned</h3>
    @include('motor-revision::frontend.components.partials.traveler-list-without-shuttle', ['travelers' => $toAirportWithoutShuttle])
@endif

@if ($toPartyWithShuttle->count() > 0)
    <h3>TO Revision with shuttle bus assigned</h3>
    @include('motor-revision::frontend.components.partials.traveler-list-with-shuttle', ['travelers' => $toPartyWithShuttle])
@endif

@if ($toAirportWithShuttle->count() > 0)
    <h3>FROM Revision with shuttle bus assigned</h3>
    @include('motor-revision::frontend.components.partials.traveler-list-with-shuttle', ['travelers' => $toAirportWithShuttle])
@endif
@if ($confirmedShuttlesToParty->count() > 0)
    <h3>Confirmed shuttle buses TO Revision</h3>
    @include('motor-revision::frontend.components.partials.shuttle-list', ['shuttles' => $confirmedShuttlesToParty])
@endif

@if ($confirmedShuttlesToAirport->count() > 0)
    <h3>Confirmed shuttle buses FROM Revision</h3>
    @include('motor-revision::frontend.components.partials.shuttle-list', ['shuttles' => $confirmedShuttlesToAirport])
@endif
