<?php

namespace Motor\Revision\Forms\Backend\Ticket;

use Kris\LaravelFormBuilder\Form;

class AtHomeForm extends Form
{
    public function buildForm()
    {
        $this->add('handle', 'text', [ 'label' => trans('motor-revision::backend/tickets.handle') ])
            ->add('name', 'text', [ 'label' => trans('motor-revision::backend/tickets.name'), 'rules' => 'required' ])
            ->add('address', 'text', [ 'label' => trans('motor-revision::backend/tickets.address'), 'rules' => 'required' ])
            ->add('zip', 'text', [ 'label' => trans('motor-revision::backend/tickets.zip'), 'rules' => 'required' ])
            ->add('city', 'text', [ 'label' => trans('motor-revision::backend/tickets.city'), 'rules' => 'required' ])
            ->add('country', 'text', [ 'label' => trans('motor-revision::backend/tickets.country'), 'rules' => 'required' ])
            ->add('email', 'text', [ 'label' => trans('motor-revision::backend/tickets.email'), 'rules' => ['email'] ])
            ->add('comment', 'textarea', [ 'label' => trans('motor-revision::backend/tickets.comment') ])
            ->add('internal_comment', 'textarea',
                [ 'label' => trans('motor-revision::backend/tickets.internal_comment') ])
            ->add('access_key', 'text', [ 'label' => trans('motor-revision::backend/tickets.access_key') ])
            ->add('shirt_size', 'select', [
                'label'   => trans('motor-revision::backend/tickets.shirt_size'),
                'choices' => trans('motor-revision::backend/tickets.shirt_sizes')
            ]);
    }
}
