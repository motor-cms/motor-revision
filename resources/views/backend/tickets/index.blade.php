@extends('motor-backend::layouts.backend')

@section('htmlheader_title')
    {{ trans('motor-backend::backend/global.home') }}
@endsection

@section('contentheader_title')
    {{ trans('motor-revision::backend/tickets.tickets') }}
    @if (has_permission('tickets.write'))
	    {!! link_to_route('backend.tickets.create', trans('motor-revision::backend/tickets.new'), [], ['class' => 'pull-right float-right btn btn-sm btn-success']) !!}
    @endif
@endsection

@section('main-content')
    <div class="@boxWrapper">
        <div class="@boxHeader">
            @include('motor-backend::layouts.partials.search')
        </div>
        <!-- /.box-header -->
        @if (isset($grid))
            @include('motor-backend::grid.table')
        @endif
    </div>
@endsection

@section('view_scripts')
    <script type="text/javascript">
        $('.delete-record').click(function (e) {
            if (!confirm('{{ trans('motor-backend::backend/global.delete_question') }}')) {
                e.preventDefault();
                return false;
            }
        });
        let apiToken = '{{Auth::user()->api_token}}';

        let updateTicket = function (that, recordId, data, callback) {
            $.ajax({
                type: 'PATCH',
                url: '{{action('\Motor\Revision\Http\Controllers\Api\TicketsController@index')}}/' + recordId + '?api_token=' + apiToken,
                data: data
            }).done(function (results) {
                callback(that, results);
            });
        };

        $('.change-ticket-status').click(function (e) {
            e.preventDefault();

            updateTicket(this, $(this).data('entry'), {status: $(this).data('status')}, function (that, results) {
                $(that).parent().find('.change-ticket-status').each(function (index, element) {
                    $(element).removeClass($(element).data('class'));
                    $(element).addClass('btn-outline-secondary');
                });
                $(that).removeClass('btn-outline-secondary');
                $(that).addClass($(that).data('class'));

                toastr.options = {progressBar: true};
                toastr.success('{{trans('motor-revision::backend/tickets.status_changed')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
            });
        });
    </script>
@append
