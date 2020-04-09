<?php

namespace Motor\Revision\Forms\Backend;

use Kris\LaravelFormBuilder\Form;

class SponsorForm extends Form
{
    public function buildForm()
    {
        $this
            ->add(
                'name',
                'text',
                [ 'label' => trans('motor-revision::backend/sponsors.name'), 'rules' => 'required' ]
            )
            ->add(
                'url',
                'text',
                [ 'label' => trans('motor-revision::backend/sponsors.url')]
            )
            ->add('level', 'select', [
                'label'   => trans('motor-revision::backend/sponsors.level'),
                'choices' => trans('motor-revision::backend/sponsors.levels'),
            ])
            ->add(
                'text',
                'htmleditor',
                [ 'label' => trans('motor-revision::backend/sponsors.text')]
            )
            ->add(
                'sort_position',
                'text',
                [ 'label' => trans('motor-revision::backend/sponsors.sort_position')]
            )
            ->add(
                'is_active',
                'checkbox',
                [ 'label' => trans('motor-revision::backend/sponsors.is_active')]
            )
            ->add(
                'logo_big',
                'file_association',
                [ 'label' => trans('motor-revision::backend/sponsors.logo_big')]
            )
            ->add(
                'logo_small',
                'file_association',
                [ 'label' => trans('motor-revision::backend/sponsors.logo_small')]
            )
            ->add('submit', 'submit', [
                'attr'  => [ 'class' => 'btn btn-primary' ],
                'label' => trans('motor-revision::backend/sponsors.save')
            ]);
    }
}
