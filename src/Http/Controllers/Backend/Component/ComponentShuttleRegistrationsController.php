<?php

namespace Motor\Revision\Http\Controllers\Backend\Component;

use Illuminate\Http\Request;
use Motor\CMS\Http\Controllers\Component\ComponentController;

use Motor\Revision\Forms\Backend\Component\ComponentShuttleRegistrationForm;

use Kris\LaravelFormBuilder\FormBuilderTrait;

class ComponentShuttleRegistrationsController extends ComponentController
{
    use FormBuilderTrait;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $this->form = $this->form(ComponentShuttleRegistrationForm::class);

        return response()->json($this->getFormData('component.shuttle-registrations.store', ['mediapool' => false]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->form = $this->form(ComponentShuttleRegistrationForm::class);

        if (! $this->isValid()) {
            return $this->respondWithValidationError();
        }

        ComponentShuttleRegistrationService::createWithForm($request, $this->form);

        return response()->json(['message' => trans('motor-revision::component/shuttle-registrations.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Motor\Revision\Models\Component\ComponentShuttleRegistration $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(ComponentShuttleRegistration $record)
    {
        $this->form = $this->form(ComponentShuttleRegistrationForm::class, [
            'model' => $record,
        ]);

        return response()->json($this->getFormData('component.shuttle-registrations.update', ['mediapool' => false]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Motor\Revision\Models\Component\ComponentShuttleRegistration $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, ComponentShuttleRegistration $record)
    {
        $form = $this->form(ComponentShuttleRegistrationForm::class);

        if (! $this->isValid()) {
            return $this->respondWithValidationError();
        }

        ComponentShuttleRegistrationService::updateWithForm($record, $request, $form);

        return response()->json(['message' => trans('motor-revision::component/shuttle-registrations.updated')]);
    }
}
