<table class="unstriped">
    <thead>
    <tr>
        <th>Bus</th>
        <th>Airport</th>
        <th>Seats</th>
        <th>Taken</th>
        <th>Free</th>
        <th>Departure</th>
        <th>Duration</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($shuttles as $shuttle)
        <tr>
            <td>
                {{$shuttle->name}}
            </td>
            <td>
                {{$shuttle->airport->name}} ({{$shuttle->airport->code}})
            </td>
            <td>
                {{$shuttle->seats}}
            </td>
            <td>
                {{$shuttle->seats_taken}}
            </td>
            <td>
                {{$shuttle->seats - $shuttle->seats_taken}}
            </td>
            <td>
                {{$shuttle->departs_at}}
            </td>
            <td>
                {{(floor($shuttle->travel_time/60))}}h{{$shuttle->travel_time%60}}m
            </td>
            <td>
                {{$shuttle->price}} €
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
