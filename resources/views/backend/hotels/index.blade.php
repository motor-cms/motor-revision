@extends('motor-backend::layouts.backend')

@section('htmlheader_title')
    {{ trans('motor-backend::backend/global.home') }}
@endsection

@section('contentheader_title')
    {{ trans('motor-revision::backend/hotels.hotels') }}
    @if (has_permission('hotels.write'))
	    {!! link_to_route('backend.hotels.create', trans('motor-revision::backend/hotels.new'), [], ['class' => 'pull-right float-right btn btn-sm btn-success']) !!}
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
    </script>
@append
