<?php

namespace Motor\Revision\Forms\Component\Ticket;

use Kris\LaravelFormBuilder\Form;

class AtHomeForm extends Form
{
    public function buildForm()
    {
        $this->add('handle', 'text', ['label' => trans('motor-revision::backend/tickets.handle')])
            ->add('type', 'hidden', ['default_value' => 'at_home'])
            ->add('name', 'text', ['label' => trans('motor-revision::backend/tickets.name'), 'rules' => 'required'])
            ->add('address', 'text', [
                'label' => trans('motor-revision::backend/tickets.address'),
                'rules' => 'required',
            ])
            ->add('zip', 'text', ['label' => trans('motor-revision::backend/tickets.zip'), 'rules' => 'required'])
            ->add('city', 'text', ['label' => trans('motor-revision::backend/tickets.city'), 'rules' => 'required'])
            ->add('country', 'text', [
                'label' => trans('motor-revision::backend/tickets.country'),
                'rules' => 'required',
            ])
            ->add('email', 'text', [
                'label' => trans('motor-revision::backend/tickets.email'),
                'rules' => 'email|required',
            ])
            ->add('comment', 'textarea', ['label' => trans('motor-revision::backend/tickets.comment')])
            ->add('shirt_size', 'select', [
                'label' => trans('motor-revision::backend/tickets.shirt_size'),
                'choices' => trans('motor-revision::backend/tickets.shirt_sizes'),
            ]);

        $this->add('submit', 'submit', [
            'attr' => ['class' => 'success button expanded'],
            'label' => trans('motor-revision::component/tickets.at_home_save'),
        ]);
    }
}
