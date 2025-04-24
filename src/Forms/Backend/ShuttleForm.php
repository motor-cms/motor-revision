<?php

namespace Motor\Revision\Forms\Backend;

use Kris\LaravelFormBuilder\Form;
use Motor\Revision\Models\Airport;

class ShuttleForm extends Form
{
    public function buildForm()
    {
        $this->add('airport_id', 'select', [
            'label' => trans('motor-revision::backend/airports.airport'),
            'choices' => Airport::pluck('name', 'id')
                ->toArray(),
        ])
            ->add('direction', 'select', [
                'label' => trans('motor-revision::backend/shuttles.direction'),
                'choices' => trans('motor-revision::backend/shuttles.directions'),
            ])
            ->add('name', 'text', ['label' => trans('motor-revision::backend/shuttles.name'), 'rules' => 'required'])
            ->add('arrives_at', 'datetimepicker', [
                'label' => trans('motor-revision::backend/shuttles.arrives_at'),
                'rules' => 'required',
            ])
            ->add('departs_at', 'datetimepicker', [
                'label' => trans('motor-revision::backend/shuttles.departs_at'),
                'rules' => 'required',
            ])
            ->add('travel_time', 'text', [
                'label' => trans('motor-revision::backend/shuttles.travel_time'),
                'rules' => 'required',
            ])
            ->add('seats', 'text', ['label' => trans('motor-revision::backend/shuttles.seats'), 'rules' => 'required'])
            ->add('price', 'text', ['label' => trans('motor-revision::backend/shuttles.price'), 'rules' => 'required'])
            ->add('is_active', 'checkbox', ['label' => trans('motor-revision::backend/shuttles.is_active')])
            ->add('submit', 'submit', [
                'attr' => ['class' => 'btn btn-primary'],
                'label' => trans('motor-revision::backend/shuttles.save'),
            ]);
    }
}
