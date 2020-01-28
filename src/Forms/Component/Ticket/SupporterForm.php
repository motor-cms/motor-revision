<?php

namespace Motor\Revision\Forms\Component\Ticket;

use Kris\LaravelFormBuilder\Form;

class SupporterForm extends Form
{
    public function buildForm()
    {
        $this->add('handle', 'text', [ 'label' => trans('motor-revision::backend/tickets.handle') ])
            ->add('type', 'hidden', [ 'default_value' => 'supporter' ])
            ->add('name', 'text', [ 'label' => trans('motor-revision::backend/tickets.name'), 'rules' => 'required' ])
            ->add('company', 'text', [ 'label' => trans('motor-revision::backend/tickets.company') ])
            ->add('vat_id', 'text', [ 'label' => trans('motor-revision::backend/tickets.vat_id') ])
            ->add('address', 'text',
                [ 'label' => trans('motor-revision::backend/tickets.address'), 'rules' => 'required' ])
            ->add('zip', 'text', [ 'label' => trans('motor-revision::backend/tickets.zip'), 'rules' => 'required' ])
            ->add('city', 'text', [ 'label' => trans('motor-revision::backend/tickets.city'), 'rules' => 'required' ])
            ->add('country', 'text',
                [ 'label' => trans('motor-revision::backend/tickets.country'), 'rules' => 'required' ])
            ->add('email', 'text',
                [ 'label' => trans('motor-revision::backend/tickets.email'), 'rules' => 'email|required' ])
            ->add('comment', 'textarea', [ 'label' => trans('motor-revision::backend/tickets.comment') ])
            ->add('shirt_size', 'select', [
                'label'   => trans('motor-revision::backend/tickets.shirt_size'),
                'choices' => trans('motor-revision::backend/tickets.shirt_sizes')
            ])
            ->add('amount', 'select', [
                'label'   => trans('motor-revision::backend/tickets.amount'),
                'choices' => trans('motor-revision::backend/tickets.amounts')
            ])
            ->add('is_anonymous', 'checkbox', [
                'label' => trans('motor-revision::backend/tickets.is_anonymous'),
            ]);

        $this->add('submit', 'submit', [
            'attr'  => [ 'class' => 'success button expanded'],
            'label' => trans('motor-revision::component/tickets.supporter_save')
        ]);
    }
}
