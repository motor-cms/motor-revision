<?php

namespace Motor\Revision\Http\Controllers\Backend;

use Kris\LaravelFormBuilder\FormBuilderTrait;
use Motor\Backend\Http\Controllers\Controller;
use Motor\Revision\Forms\Backend\TicketForm;
use Motor\Revision\Grids\TicketGrid;
use Motor\Revision\Http\Requests\Backend\TicketRequest;
use Motor\Revision\Models\Ticket;
use Motor\Revision\Services\TicketService;

/**
 * Class TicketsController
 *
 * @package Motor\Revision\Http\Controllers\Backend
 */
class TicketsController extends Controller
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \ReflectionException
     */
    public function index()
    {
        $grid = new TicketGrid(Ticket::class);

        $service = TicketService::collection($grid);
        $grid->setFilter($service->getFilter());
        $paginator = $service->getPaginator();

        return view('motor-revision::backend.tickets.index', compact('paginator', 'grid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $form = $this->form(TicketForm::class, [
            'method'  => 'POST',
            'route'   => 'backend.tickets.store',
            'enctype' => 'multipart/form-data',
        ]);

        return view('motor-revision::backend.tickets.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TicketRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TicketRequest $request)
    {
        $form = $this->form(TicketForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ((int) $request->get('reload_on_change') == 1) {
            return redirect()
                ->back()
                ->withInput();
        }
        if (! $form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        TicketService::createWithForm($request, $form);

        flash()->success(trans('motor-revision::backend/tickets.created'));

        return redirect('backend/tickets');
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $record
     */
    public function show(Ticket $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ticket $record
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Ticket $record)
    {
        $form = $this->form(TicketForm::class, [
            'method'  => 'PATCH',
            'url'     => route('backend.tickets.update', [$record->id]),
            'enctype' => 'multipart/form-data',
            'model'   => $record,
        ]);

        return view('motor-revision::backend.tickets.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TicketRequest $request
     * @param Ticket $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TicketRequest $request, Ticket $record)
    {
        $form = $this->form(TicketForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (! $form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        TicketService::updateWithForm($record, $request, $form);

        flash()->success(trans('motor-revision::backend/tickets.updated'));

        return redirect('backend/tickets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Ticket $record)
    {
        TicketService::delete($record);

        flash()->success(trans('motor-revision::backend/tickets.deleted'));

        return redirect('backend/tickets');
    }
}
