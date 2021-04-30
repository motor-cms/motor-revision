<?php

namespace Motor\Revision\Forms\Backend;

use Kris\LaravelFormBuilder\Form;
use Motor\Revision\Models\Airport;
use Motor\Revision\Models\Shuttle;

class TravelerForm extends Form
{
    public function buildForm()
    {
        $this->add('airport_id', 'select', [
                'label'   => trans('motor-revision::backend/airports.airport'),
                'choices' => Airport::pluck('name', 'id')
                                    ->toArray(),
            ])
             ->add('shuttle_id', 'select', [
                 'label'       => trans('motor-revision::backend/shuttles.shuttle'),
                 'choices'     => Shuttle::pluck('name', 'id')
                                         ->toArray(),
                 'empty_value' => trans('motor-backend::backend/global.please_choose'),
             ])
             ->add('direction', 'select', [
                 'label'   => trans('motor-revision::backend/shuttles.direction'),
                 'choices' => trans('motor-revision::backend/shuttles.directions'),
             ])
             ->add('name', 'text', ['label' => trans('motor-revision::backend/travelers.name'), 'rules' => 'required'])
             ->add('email', 'text', [
                     'label' => trans('motor-revision::backend/travelers.email'),
                     'rules' => 'required',
                 ])
             ->add('mobile_phone', 'text', [
                     'label' => trans('motor-revision::backend/travelers.mobile_phone'),
                     'rules' => 'required',
                 ])
             ->add('flight_time', 'datetimepicker', [
                     'label' => trans('motor-revision::backend/travelers.flight_time'),
                     'rules' => 'required',
                 ])
             ->add('flight_number', 'text', [
                     'label' => trans('motor-revision::backend/travelers.flight_number'),
                     'rules' => 'required',
                 ])
             ->add('number_of_people', 'text', [
                     'label' => trans('motor-revision::backend/travelers.number_of_people'),
                     'rules' => 'required',
                 ])
             ->add('submit', 'submit', [
                 'attr'  => ['class' => 'btn btn-primary'],
                 'label' => trans('motor-revision::backend/travelers.save'),
             ]);
    }
}
