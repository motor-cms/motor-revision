<?php

namespace Motor\Revision\Http\Controllers\Backend;

use Kris\LaravelFormBuilder\FormBuilderTrait;
use Motor\Backend\Http\Controllers\Controller;
use Motor\Revision\Forms\Backend\TravelerForm;
use Motor\Revision\Grids\TravelerGrid;
use Motor\Revision\Http\Requests\Backend\TravelerRequest;
use Motor\Revision\Models\Traveler;
use Motor\Revision\Services\TravelerService;

/**
 * Class TravelersController
 */
class TravelersController extends Controller
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \ReflectionException
     */
    public function index()
    {
        $grid = new TravelerGrid(Traveler::class);

        $service = TravelerService::collection($grid);
        $grid->setFilter($service->getFilter());
        $paginator = $service->getPaginator();

        return view('motor-revision::backend.travelers.index', compact('paginator', 'grid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $form = $this->form(TravelerForm::class, [
            'method' => 'POST',
            'route' => 'backend.travelers.store',
            'enctype' => 'multipart/form-data',
        ]);

        return view('motor-revision::backend.travelers.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TravelerRequest $request)
    {
        $form = $this->form(TravelerForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (! $form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        TravelerService::createWithForm($request, $form);

        flash()->success(trans('motor-revision::backend/travelers.created'));

        return redirect('backend/travelers');
    }

    /**
     * Display the specified resource.
     */
    public function show(Traveler $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Traveler $record)
    {
        $form = $this->form(TravelerForm::class, [
            'method' => 'PATCH',
            'url' => route('backend.travelers.update', [$record->id]),
            'enctype' => 'multipart/form-data',
            'model' => $record,
        ]);

        return view('motor-revision::backend.travelers.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TravelerRequest $request, Traveler $record)
    {
        $form = $this->form(TravelerForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (! $form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        TravelerService::updateWithForm($record, $request, $form);

        flash()->success(trans('motor-revision::backend/travelers.updated'));

        return redirect('backend/travelers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Traveler $record)
    {
        TravelerService::delete($record);

        flash()->success(trans('motor-revision::backend/travelers.deleted'));

        return redirect('backend/travelers');
    }
}
