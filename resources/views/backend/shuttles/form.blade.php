{!! form_start($form) !!}
<div class="@boxWrapper box-primary">
    <div class="@boxHeader with-border">
        <h3 class="box-title">{{ trans('motor-backend::backend/global.base_info') }}</h3>
    </div>
    <div class="@boxBody">
        {!! form_row($form->airport_id) !!}
        {!! form_row($form->name) !!}
        {!! form_row($form->direction) !!}
        {!! form_row($form->departs_at) !!}
        {!! form_row($form->arrives_at) !!}
        {!! form_row($form->travel_time) !!}
        {!! form_row($form->seats) !!}
        {!! form_row($form->price) !!}
        {!! form_row($form->is_active) !!}
    </div>
    <!-- /.box-body -->

    <div class="@boxFooter">
        {!! form_row($form->submit) !!}
    </div>
</div>
{!! form_end($form) !!}
