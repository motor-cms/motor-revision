@if (count(session('flash_notification', collect())->toArray()) == 0)

    {!! form_start($shuttleForm) !!}

    {!! form_row($shuttleForm->name) !!}
    {!! form_row($shuttleForm->email) !!}
    {!! form_row($shuttleForm->mobile_phone) !!}

    {!! form_row($shuttleForm->shuttle_to_party) !!}
    <div class="shuttle-to-party hide">
        {!! form_row($shuttleForm->arrival_airport_id) !!}
        {!! form_row($shuttleForm->arrival_flight_time) !!}
        {!! form_row($shuttleForm->arrival_flight_number) !!}
        {!! form_row($shuttleForm->arrival_number_of_people) !!}
    </div>

    {!! form_row($shuttleForm->shuttle_to_airport) !!}

    <div class="shuttle-to-airport hide">
        {!! form_row($shuttleForm->departure_airport_id) !!}
        {!! form_row($shuttleForm->departure_flight_time) !!}
        {!! form_row($shuttleForm->departure_flight_number) !!}
        {!! form_row($shuttleForm->departure_number_of_people) !!}
    </div>

    {!! form_row($shuttleForm->submit) !!}
    {!! form_end($shuttleForm, false) !!}

@else
    <div class="callout success">
        @foreach (session('flash_notification', collect())->toArray() as $message)
            {!! $message['message'] !!}
        @endforeach
    </div>
@endif
@section('view-scripts')
<script>
    $(document).ready(function() {
        $("#shuttle_to_party").change(function () {
            if ($(this).is(':checked')) {
                $('#arrival_airport_id').prop('required', true);
                $('#arrival_flight_time').prop('required', true);
                $('#arrival_flight_number').prop('required', true);
                $('#arrival_number_of_people').prop('required', true);
                $('.shuttle-to-party').removeClass('hide');
            } else {
                $('#arrival_airport_id').prop('required', false);
                $('#arrival_flight_time').prop('required', false);
                $('#arrival_flight_number').prop('required', false);
                $('#arrival_number_of_people').prop('required', false);
                $('.shuttle-to-party').addClass('hide');
            }
        });
        $("#shuttle_to_airport").change(function () {
            if ($(this).is(':checked')) {
                $('#departure_airport_id').prop('required', true);
                $('#departure_flight_time').prop('required', true);
                $('#departure_flight_number').prop('required', true);
                $('#departure_number_of_people').prop('required', true);
                $('.shuttle-to-airport').removeClass('hide');
            } else {
                $('#departure_airport_id').prop('required', false);
                $('#departure_flight_number').prop('required', false);
                $('#departure_flight_number').prop('required', false);
                $('#departure_number_of_people').prop('required', false);
                $('.shuttle-to-airport').addClass('hide');
            }
        });

        $('#arrival_flight_time').fdatepicker({
            format: 'yyyy-mm-dd hh:ii',
            disableDblClickSelection: true,
            language: 'en',
            pickTime: true,
            initialDate: '2020-04-10 00:00',
            startDate: '2020-04-09 00:00',
            endDate: '2020-04-10 23:59',
        });

        $('#departure_flight_time').fdatepicker({
            format: 'yyyy-mm-dd hh:ii',
            disableDblClickSelection: true,
            language: 'en',
            pickTime: true,
            initialDate: '2020-04-13 00:00',
            startDate: '2020-04-13 00:00',
            endDate: '2020-04-13 23:59',
        });
    });
</script>
@endsection
