<?php

namespace Motor\Revision\Http\Controllers\Backend;

use Motor\Backend\Http\Controllers\Controller;

use Motor\Revision\Models\Traveler;
use Motor\Revision\Http\Requests\Backend\TravelerRequest;
use Motor\Revision\Services\TravelerService;
use Motor\Revision\Grids\TravelerGrid;
use Motor\Revision\Forms\Backend\TravelerForm;
use Kris\LaravelFormBuilder\FormBuilderTrait;

/**
 * Class TravelersController
 * @package Motor\Revision\Http\Controllers\Backend
 */
class TravelersController extends Controller
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
        $grid = new TravelerGrid(Traveler::class);

        $service = TravelerService::collection($grid);
        $grid->setFilter($service->getFilter());
        $paginator = $service->getPaginator();

        return view('motor-revision::backend.travelers.index', compact('paginator', 'grid'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->form(TravelerForm::class, [
            'method'  => 'POST',
            'route'   => 'backend.travelers.store',
            'enctype' => 'multipart/form-data'
        ]);

        return view('motor-revision::backend.travelers.create', compact('form'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param TravelerRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TravelerRequest $request)
    {
        $form = $this->form(TravelerForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        TravelerService::createWithForm($request, $form);

        flash()->success(trans('motor-revision::backend/travelers.created'));

        return redirect('backend/travelers');
    }


    /**
     * Display the specified resource.
     *
     * @param Traveler $record
     */
    public function show(Traveler $record)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Traveler $record
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Traveler $record)
    {
        $form = $this->form(TravelerForm::class, [
            'method'  => 'PATCH',
            'url'     => route('backend.travelers.update', [ $record->id ]),
            'enctype' => 'multipart/form-data',
            'model'   => $record
        ]);

        return view('motor-revision::backend.travelers.edit', compact('form'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param TravelerRequest $request
     * @param Traveler   $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TravelerRequest $request, Traveler $record)
    {
        $form = $this->form(TravelerForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        TravelerService::updateWithForm($record, $request, $form);

        flash()->success(trans('motor-revision::backend/travelers.updated'));

        return redirect('backend/travelers');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Traveler $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Traveler $record)
    {
        TravelerService::delete($record);

        flash()->success(trans('motor-revision::backend/travelers.deleted'));

        return redirect('backend/travelers');
    }
}
