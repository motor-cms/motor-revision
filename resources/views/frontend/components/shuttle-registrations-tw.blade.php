@if (count(session('flash_notification', collect())->toArray()) == 0)

    <div x-data="{
        shuttleToParty: false,
        shuttleToAirport: false
    }">
        {!! form_start($shuttleForm) !!}

        {!! form_row($shuttleForm->name) !!}
        {!! form_row($shuttleForm->email) !!}
        {!! form_row($shuttleForm->mobile_phone) !!}

        {!! form_row($shuttleForm->shuttle_to_party) !!}
        <div x-show="shuttleToParty" x-cloak
             x-init="$watch('shuttleToParty', val => {
                 document.getElementById('arrival_airport_id').required = val;
                 document.getElementById('arrival_flight_time').required = val;
                 document.getElementById('arrival_flight_number').required = val;
                 document.getElementById('arrival_number_of_people').required = val;
             })"
             @change.window="if ($event.target.id === 'shuttle_to_party') shuttleToParty = $event.target.checked">
            {!! form_row($shuttleForm->arrival_airport_id) !!}
            {!! form_row($shuttleForm->arrival_flight_time) !!}
            {!! form_row($shuttleForm->arrival_flight_number) !!}
            {!! form_row($shuttleForm->arrival_number_of_people) !!}
        </div>

        {!! form_row($shuttleForm->shuttle_to_airport) !!}

        <div x-show="shuttleToAirport" x-cloak
             x-init="$watch('shuttleToAirport', val => {
                 document.getElementById('departure_airport_id').required = val;
                 document.getElementById('departure_flight_time').required = val;
                 document.getElementById('departure_flight_number').required = val;
                 document.getElementById('departure_number_of_people').required = val;
             })"
             @change.window="if ($event.target.id === 'shuttle_to_airport') shuttleToAirport = $event.target.checked">
            {!! form_row($shuttleForm->departure_airport_id) !!}
            {!! form_row($shuttleForm->departure_flight_time) !!}
            {!! form_row($shuttleForm->departure_flight_number) !!}
            {!! form_row($shuttleForm->departure_number_of_people) !!}
        </div>

        {!! form_row($shuttleForm->submit) !!}
        {!! form_end($shuttleForm, false) !!}
    </div>

@else
    <div class="alert alert-success">
        @foreach (session('flash_notification', collect())->toArray() as $message)
            {!! $message['message'] !!}
        @endforeach
    </div>
@endif
