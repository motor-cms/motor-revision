<?php

namespace Motor\Revision\Forms\Backend;

use Kris\LaravelFormBuilder\Form;

class AirportForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', ['label' => trans('motor-revision::backend/airports.name'), 'rules' => 'required'])
             ->add('code', 'text', ['label' => trans('motor-revision::backend/airports.code'), 'rules' => 'required'])
             ->add('sort_position', 'text', ['label' => trans('motor-revision::backend/airports.sort_position')])
             ->add('is_active', 'checkbox', ['label' => trans('motor-revision::backend/airports.is_active')])
             ->add('submit', 'submit', [
                 'attr'  => ['class' => 'btn btn-primary'],
                 'label' => trans('motor-revision::backend/airports.save'),
             ]);
    }
}
