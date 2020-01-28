{!! form_start($form) !!}
<div class="@boxWrapper box-primary">
    <div class="@boxHeader with-border">
        <h3 class="box-title">{{ trans('motor-backend::backend/global.base_info') }}</h3>
    </div>
    <div class="@boxBody">
        {!! form_row($form->type) !!}
        {!! form_row($form->reload_on_change) !!}

        @if (isset($form->at_home))
            {!! form_row($form->at_home->handle) !!}
            {!! form_row($form->at_home->name) !!}
            {!! form_row($form->at_home->address) !!}
            {!! form_row($form->at_home->zip) !!}
            {!! form_row($form->at_home->city) !!}
            {!! form_row($form->at_home->country) !!}
            {!! form_row($form->at_home->email) !!}
            {!! form_row($form->at_home->comment) !!}
            {!! form_row($form->at_home->internal_comment) !!}
            {!! form_row($form->at_home->shirt_size) !!}
            {!! form_row($form->at_home->access_key) !!}
        @endif

        @if (isset($form->supporter))
            {!! form_row($form->supporter->handle) !!}
            {!! form_row($form->supporter->name) !!}
            {!! form_row($form->supporter->company) !!}
            {!! form_row($form->supporter->vat_id) !!}
            {!! form_row($form->supporter->address) !!}
            {!! form_row($form->supporter->zip) !!}
            {!! form_row($form->supporter->city) !!}
            {!! form_row($form->supporter->country) !!}
            {!! form_row($form->supporter->email) !!}
            {!! form_row($form->supporter->comment) !!}
            {!! form_row($form->supporter->internal_comment) !!}
            {!! form_row($form->supporter->amount) !!}
            {!! form_row($form->supporter->is_anonymous) !!}
            {!! form_row($form->supporter->shirt_size) !!}
        @endif

        @if (isset($form->subsidized))
            {!! form_row($form->subsidized->handle) !!}
            {!! form_row($form->subsidized->name) !!}
            {!! form_row($form->subsidized->address) !!}
            {!! form_row($form->subsidized->zip) !!}
            {!! form_row($form->subsidized->city) !!}
            {!! form_row($form->subsidized->country) !!}
            {!! form_row($form->subsidized->email) !!}
            {!! form_row($form->subsidized->comment) !!}
            {!! form_row($form->subsidized->transportation) !!}
        @endif
    </div>
    <!-- /.box-body -->

    @if (isset($form->submit))
        <div class="@boxFooter">
            {!! form_row($form->submit) !!}
        </div>
    @endif
</div>
{!! form_end($form, false) !!}
@section('view_scripts')
    <script type="text/javascript">
        $('.reload-on-change').change(function (e) {
            $('#reload_on_change').val(1);
            $(this).closest('form').submit();
        });
        $('#reload_on_change').val('');
    </script>
@append
