<div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead>
        <tr>
            <th class="px-4 py-3 font-medium text-heading bg-surface">Name</th>
            <th class="px-4 py-3 font-medium text-heading bg-surface">Persons</th>
            <th class="px-4 py-3 font-medium text-heading bg-surface">Airport</th>
            <th class="px-4 py-3 font-medium text-heading bg-surface">Flight</th>
            <th class="px-4 py-3 font-medium text-heading bg-surface">Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($travelers as $traveler)
            <tr>
                <td class="px-4 py-3 border-t border-border text-text">
                    {{$traveler->name}}
                </td>
                <td class="px-4 py-3 border-t border-border text-text">
                    {{$traveler->number_of_people}}
                </td>
                <td class="px-4 py-3 border-t border-border text-text">
                   {{$traveler->airport->code}}
                </td>
                <td class="px-4 py-3 border-t border-border text-text">
                    {{$traveler->flight_number}}
                </td>
                <td class="px-4 py-3 border-t border-border text-text">
                    {{$traveler->flight_time}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
