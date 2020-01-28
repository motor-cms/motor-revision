@if ($record->type === 'at_home')
    <div class="btn-group" role="group">
        <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="0" data-class="btn-warning" class="change-ticket-status btn @defaultButtonSize @if ($record->status == 0)btn-warning @else btn-outline-secondary @endif">{{trans('motor-revision::backend/tickets.at_home_stati.0')}}</button>
        <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="1" data-class="btn-warning" class="change-ticket-status btn @defaultButtonSize @if ($record->status == 1)btn-warning @else btn-outline-secondary @endif">{{trans('motor-revision::backend/tickets.at_home_stati.1')}}</button>
        <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="2" data-class="btn-warning" class="change-ticket-status btn @defaultButtonSize @if ($record->status == 2)btn-warning @else btn-outline-secondary @endif">{{trans('motor-revision::backend/tickets.at_home_stati.2')}}</button>
        <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="3" data-class="btn-success" class="change-ticket-status btn @defaultButtonSize @if ($record->status == 3)btn-success @else btn-outline-secondary @endif">{{trans('motor-revision::backend/tickets.at_home_stati.3')}}</button>
    </div>
@endif
@if ($record->type === 'supporter')
    <div class="btn-group" role="group">
        <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="0" data-class="btn-warning" class="change-ticket-status btn @defaultButtonSize @if ($record->status == 0)btn-warning @else btn-outline-secondary @endif">{{trans('motor-revision::backend/tickets.supporter_stati.0')}}</button>
        <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="1" data-class="btn-warning" class="change-ticket-status btn @defaultButtonSize @if ($record->status == 1)btn-warning @else btn-outline-secondary @endif">{{trans('motor-revision::backend/tickets.supporter_stati.1')}}</button>
        <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="2" data-class="btn-success" class="change-ticket-status btn @defaultButtonSize @if ($record->status == 2)btn-success @else btn-outline-secondary @endif">{{trans('motor-revision::backend/tickets.supporter_stati.2')}}</button>
    </div>
@endif

@if ($record->type === 'subsidized')
    <div class="btn-group" role="group">
        <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="0" data-class="btn-warning" class="change-ticket-status btn @defaultButtonSize @if ($record->status == 0)btn-warning @else btn-outline-secondary @endif">{{trans('motor-revision::backend/tickets.subsidized_stati.0')}}</button>
        <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="1" data-class="btn-success" class="change-ticket-status btn @defaultButtonSize @if ($record->status == 1)btn-success @else btn-outline-secondary @endif">{{trans('motor-revision::backend/tickets.subsidized_stati.1')}}</button>
        <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="2" data-class="btn-danger" class="change-ticket-status btn @defaultButtonSize @if ($record->status == 2)btn-danger @else btn-outline-secondary @endif">{{trans('motor-revision::backend/tickets.subsidized_stati.2')}}</button>
    </div>
@endif
