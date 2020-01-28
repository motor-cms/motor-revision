@if (count(session('flash_notification', collect())->toArray()) == 0)

    {!! form_start($ticketForm) !!}

    @if ($component->type === 'at_home')
        {!! form_row($ticketForm->type) !!}
        {!! form_row($ticketForm->handle) !!}
        {!! form_row($ticketForm->name) !!}
        {!! form_row($ticketForm->address) !!}
        {!! form_row($ticketForm->zip) !!}
        {!! form_row($ticketForm->city) !!}
        {!! form_row($ticketForm->country) !!}
        {!! form_row($ticketForm->email) !!}
        {!! form_row($ticketForm->comment) !!}
        {!! form_row($ticketForm->shirt_size) !!}
    @endif

    @if ($component->type === 'supporter')
        {!! form_row($ticketForm->type) !!}
        {!! form_row($ticketForm->handle) !!}
        {!! form_row($ticketForm->name) !!}
        {!! form_row($ticketForm->company) !!}
        {!! form_row($ticketForm->vat_id) !!}
        {!! form_row($ticketForm->address) !!}
        {!! form_row($ticketForm->zip) !!}
        {!! form_row($ticketForm->city) !!}
        {!! form_row($ticketForm->country) !!}
        {!! form_row($ticketForm->email) !!}
        {!! form_row($ticketForm->comment) !!}
        {!! form_row($ticketForm->amount) !!}
        {!! form_row($ticketForm->is_anonymous) !!}
        {!! form_row($ticketForm->shirt_size) !!}
    @endif

    @if ($component->type === 'subsidized')
        {!! form_row($ticketForm->type) !!}
        {!! form_row($ticketForm->handle) !!}
        {!! form_row($ticketForm->name) !!}
        {!! form_row($ticketForm->address) !!}
        {!! form_row($ticketForm->zip) !!}
        {!! form_row($ticketForm->city) !!}
        {!! form_row($ticketForm->country) !!}
        {!! form_row($ticketForm->email) !!}
        {!! form_row($ticketForm->comment) !!}
        {!! form_row($ticketForm->transportation) !!}
    @endif

    {!! form_row($ticketForm->submit) !!}
    {!! form_end($ticketForm, false) !!}

@else
    <div class="callout success">
        @foreach (session('flash_notification', collect())->toArray() as $message)
            {!! $message['message'] !!}
        @endforeach
    </div>
@endif
