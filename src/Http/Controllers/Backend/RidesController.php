<?php

namespace Motor\Revision\Http\Controllers\Backend;

use Kris\LaravelFormBuilder\FormBuilderTrait;
use Motor\Backend\Http\Controllers\Controller;
use Motor\Revision\Forms\Backend\RideForm;
use Motor\Revision\Grids\RideGrid;
use Motor\Revision\Http\Requests\Backend\RideRequest;
use Motor\Revision\Models\Ride;
use Motor\Revision\Services\RideService;

/**
 * Class RidesController
 *
 * @package Motor\Revision\Http\Controllers\Backend
 */
class RidesController extends Controller
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
        $grid = new RideGrid(Ride::class);

        $service = RideService::collection($grid);
        $grid->setFilter($service->getFilter());
        $paginator = $service->getPaginator();

        return view('motor-revision::backend.rides.index', compact('paginator', 'grid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $form = $this->form(RideForm::class, [
            'method'  => 'POST',
            'route'   => 'backend.rides.store',
            'enctype' => 'multipart/form-data',
        ]);

        return view('motor-revision::backend.rides.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RideRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RideRequest $request)
    {
        $form = $this->form(RideForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (! $form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        RideService::createWithForm($request, $form);

        flash()->success(trans('motor-revision::backend/rides.created'));

        return redirect('backend/rides');
    }

    /**
     * Display the specified resource.
     *
     * @param Ride $record
     */
    public function show(Ride $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ride $record
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Ride $record)
    {
        $form = $this->form(RideForm::class, [
            'method'  => 'PATCH',
            'url'     => route('backend.rides.update', [$record->id]),
            'enctype' => 'multipart/form-data',
            'model'   => $record,
        ]);

        return view('motor-revision::backend.rides.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RideRequest $request
     * @param Ride $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(RideRequest $request, Ride $record)
    {
        $form = $this->form(RideForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (! $form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        RideService::updateWithForm($record, $request, $form);

        flash()->success(trans('motor-revision::backend/rides.updated'));

        return redirect('backend/rides');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ride $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Ride $record)
    {
        RideService::delete($record);

        flash()->success(trans('motor-revision::backend/rides.deleted'));

        return redirect('backend/rides');
    }
}
