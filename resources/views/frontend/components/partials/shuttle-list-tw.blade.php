<div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead>
        <tr>
            <th class="px-4 py-3 font-medium text-heading bg-surface">Bus</th>
            <th class="px-4 py-3 font-medium text-heading bg-surface">Airport</th>
            <th class="px-4 py-3 font-medium text-heading bg-surface">Seats</th>
            <th class="px-4 py-3 font-medium text-heading bg-surface">Taken</th>
            <th class="px-4 py-3 font-medium text-heading bg-surface">Free</th>
            <th class="px-4 py-3 font-medium text-heading bg-surface">Departure</th>
            <th class="px-4 py-3 font-medium text-heading bg-surface">Duration</th>
            <th class="px-4 py-3 font-medium text-heading bg-surface">Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($shuttles as $shuttle)
            <tr>
                <td class="px-4 py-3 border-t border-border text-text">
                    {{$shuttle->name}}
                </td>
                <td class="px-4 py-3 border-t border-border text-text">
                    {{$shuttle->airport->name}} ({{$shuttle->airport->code}})
                </td>
                <td class="px-4 py-3 border-t border-border text-text">
                    {{$shuttle->seats}}
                </td>
                <td class="px-4 py-3 border-t border-border text-text">
                    {{$shuttle->seats_taken}}
                </td>
                <td class="px-4 py-3 border-t border-border text-text">
                    {{$shuttle->seats - $shuttle->seats_taken}}
                </td>
                <td class="px-4 py-3 border-t border-border text-text">
                    {{$shuttle->departs_at}}
                </td>
                <td class="px-4 py-3 border-t border-border text-text">
                    {{(floor($shuttle->travel_time/60))}}h{{$shuttle->travel_time%60}}m
                </td>
                <td class="px-4 py-3 border-t border-border text-text">
                    {{$shuttle->price}} &euro;
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
