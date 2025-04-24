<?php

namespace Motor\Revision\Http\Controllers\Backend\Component;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Motor\CMS\Http\Controllers\Component\ComponentController;
use Motor\Revision\Forms\Backend\Component\ComponentTicketForm;
use Motor\Revision\Models\Component\ComponentTicket;
use Motor\Revision\Services\Component\ComponentTicketService;

class ComponentTicketsController extends ComponentController
{
    use FormBuilderTrait;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $this->form = $this->form(ComponentTicketForm::class);

        return response()->json($this->getFormData('component.tickets.store', ['mediapool' => false]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->form = $this->form(ComponentTicketForm::class);

        if (! $this->isValid()) {
            return $this->respondWithValidationError();
        }

        ComponentTicketService::createWithForm($request, $this->form);

        return response()->json(['message' => trans('motorrevision::component/tickets.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(ComponentTicket $record)
    {
        $this->form = $this->form(ComponentTicketForm::class, [
            'model' => $record,
        ]);

        return response()->json($this->getFormData('component.tickets.update', ['mediapool' => false]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, ComponentTicket $record)
    {
        $form = $this->form(ComponentTicketForm::class);

        if (! $this->isValid()) {
            return $this->respondWithValidationError();
        }

        ComponentTicketService::updateWithForm($record, $request, $form);

        return response()->json(['message' => trans('motorrevision::component/tickets.updated')]);
    }
}
