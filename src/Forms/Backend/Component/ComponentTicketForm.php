<?php

namespace Motor\Revision\Forms\Backend\Component;

use Kris\LaravelFormBuilder\Form;

class ComponentTicketForm extends Form
{
    public function buildForm()
    {
        $this->add('type', 'select', [
            'label'       => trans('motor-revision::backend/tickets.type'),
            'choices'     => trans('motor-revision::backend/tickets.types'),
            'empty_value' => trans('motor-revision::backend/tickets.choose')
        ]);
    }
}
