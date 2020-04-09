{!! form_start($form) !!}
<div class="@boxWrapper box-primary">
    <div class="@boxHeader with-border">
        <h3 class="box-title">{{ trans('motor-backend::backend/global.base_info') }}</h3>
    </div>
    <div class="@boxBody">
        {!! form_row($form->name) !!}
        {!! form_row($form->url) !!}
        {!! form_row($form->level) !!}
        {!! form_row($form->text) !!}
        {!! form_row($form->sort_position) !!}
        {!! form_row($form->is_active) !!}
        {!! form_row($form->logo_big) !!}
        {!! form_row($form->logo_small) !!}

    </div>
    <!-- /.box-body -->

    <div class="@boxFooter">
        {!! form_row($form->submit) !!}
    </div>
</div>
{!! form_end($form) !!}
@section ('right-sidebar')
    <motor-media-mediapool></motor-media-mediapool>
@endsection
