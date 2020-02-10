{!! form_start($form) !!}
<div class="@boxWrapper box-primary">
    <div class="@boxHeader with-border">
        <h3 class="box-title">{{ trans('motor-backend::backend/global.base_info') }}</h3>
    </div>
    <div class="@boxBody">
        {!! form_row($form->airport_id) !!}
        {!! form_row($form->shuttle_id) !!}
        {!! form_row($form->direction) !!}
        {!! form_row($form->name) !!}
        {!! form_row($form->email) !!}
        {!! form_row($form->mobile_phone) !!}
        {!! form_row($form->flight_time) !!}
        {!! form_row($form->flight_number) !!}
        {!! form_row($form->number_of_people) !!}
    </div>
    <!-- /.box-body -->

    <div class="@boxFooter">
        {!! form_row($form->submit) !!}
    </div>
</div>
{!! form_end($form) !!}
