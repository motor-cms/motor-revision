<?php

namespace Motor\Revision\Forms\Component;

use Kris\LaravelFormBuilder\Form;
use Motor\Revision\Models\Airport;

class ShuttleRegistrationForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', ['label' => trans('motor-revision::backend/travelers.name'), 'rules' => 'required'])
            ->add('email', 'text', [
                'attr' => ['pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$'],
                'label' => trans('motor-revision::backend/travelers.email'),
                'rules' => 'required',
            ])
            ->add('mobile_phone', 'text', [
                'label' => trans('motor-revision::backend/travelers.mobile_phone'),
                'rules' => 'required',
            ])
            ->add('shuttle_to_party', 'checkbox', ['label' => trans('motor-revision::component/shuttle-registrations.shuttle_to_party')])
            ->add('shuttle_to_airport', 'checkbox', ['label' => trans('motor-revision::component/shuttle-registrations.shuttle_to_airport')])
            ->add('arrival_airport_id', 'select', [
                'label' => trans('motor-revision::backend/airports.airport'),
                'choices' => Airport::pluck('name', 'id')
                    ->toArray(),
            ])
            ->add('arrival_flight_time', 'text', ['label' => trans('motor-revision::component/shuttle-registrations.arrival_flight_time')])
            ->add('arrival_flight_number', 'text', ['label' => trans('motor-revision::backend/travelers.flight_number')])
            ->add('arrival_number_of_people', 'text', ['label' => trans('motor-revision::backend/travelers.number_of_people')])
            ->add('departure_airport_id', 'select', [
                'label' => trans('motor-revision::backend/airports.airport'),
                'choices' => Airport::pluck('name', 'id')
                    ->toArray(),
            ])
            ->add('departure_flight_time', 'text', ['label' => trans('motor-revision::component/shuttle-registrations.departure_flight_time')])
            ->add('departure_flight_number', 'text', ['label' => trans('motor-revision::backend/travelers.flight_number')])
            ->add('departure_number_of_people', 'text', ['label' => trans('motor-revision::backend/travelers.number_of_people')])
            ->add('submit', 'submit', [
                'attr' => ['class' => 'success button expanded'],
                'label' => trans('motor-revision::component/shuttle-registrations.sign_up'),
            ]);
    }
}
