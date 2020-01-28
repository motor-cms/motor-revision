<?php

namespace Motor\Revision\Models\Component;

use Motor\CMS\Models\ComponentBaseModel;

class ComponentTicket extends ComponentBaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type'
    ];

    /**
     * Preview function for the page editor
     *
     * @return mixed
     */
    public function preview()
    {
        return [
            'name'    => trans('motor-revision::component/tickets.component'),
            'preview' => trans('motor-revision::backend/tickets.types.'.$this->type)
        ];
    }
}
