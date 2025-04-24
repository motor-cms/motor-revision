<?php

namespace Motor\Revision\Forms\Backend;

use Kris\LaravelFormBuilder\Form;
use Motor\Revision\Forms\Backend\Ticket\AtHomeForm;
use Motor\Revision\Forms\Backend\Ticket\SubsidizedForm;
use Motor\Revision\Forms\Backend\Ticket\SupporterForm;

class TicketForm extends Form
{
    public function buildForm()
    {
        $this->add('type', 'select', [
            'attr' => ['class' => 'form-control reload-on-change'],
            'label' => trans('motor-revision::backend/tickets.type'),
            'choices' => trans('motor-revision::backend/tickets.types'),
            'empty_value' => trans('motor-revision::backend/tickets.choose'),
        ])
            ->add('reload_on_change', 'hidden', ['attr' => ['id' => 'reload_on_change']]);

        $type = null;
        if (old('type')) {
            $type = old('type');
        } elseif (is_object($this->getModel()) && $this->getModel()->type) {
            $type = $this->getModel()->type;
        }

        if (! is_null($type) && strlen($type) > 0) {
            $this->add('submit', 'submit', [
                'attr' => ['class' => 'btn btn-primary'],
                'label' => trans('motor-revision::backend/tickets.save'),
            ]);
        }

        switch ($type) {
            case 'at_home':
                $this->add('at_home', 'form', [
                    'label_show' => false,
                    'class' => $this->formBuilder->create(AtHomeForm::class, ['model' => ['at_home' => $this->getModel()]]),
                ]);
                break;
            case 'subsidized':
                $this->add('subsidized', 'form', [
                    'class' => $this->formBuilder->create(SubsidizedForm::class, ['model' => ['subsidized' => $this->getModel()]]),
                    'label_show' => false,
                ]);
                break;
            case 'supporter':
                $this->add('supporter', 'form', [
                    'class' => $this->formBuilder->create(SupporterForm::class, ['model' => ['supporter' => $this->getModel()]]),
                    'label_show' => false,
                ]);
                break;
        }
    }
}
