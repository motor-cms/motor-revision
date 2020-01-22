<?php

namespace Motor\Revision\Http\Controllers\Backend;

use Motor\Backend\Http\Controllers\Controller;

use Motor\Revision\Models\Airport;
use Motor\Revision\Http\Requests\Backend\AirportRequest;
use Motor\Revision\Services\AirportService;
use Motor\Revision\Grids\AirportGrid;
use Motor\Revision\Forms\Backend\AirportForm;
use Kris\LaravelFormBuilder\FormBuilderTrait;

/**
 * Class AirportsController
 * @package Motor\Revision\Http\Controllers\Backend
 */
class AirportsController extends Controller
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
        $grid = new AirportGrid(Airport::class);

        $service = AirportService::collection($grid);
        $grid->setFilter($service->getFilter());
        $paginator = $service->getPaginator();

        return view('motor-revision::backend.airports.index', compact('paginator', 'grid'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->form(AirportForm::class, [
            'method'  => 'POST',
            'route'   => 'backend.airports.store',
            'enctype' => 'multipart/form-data'
        ]);

        return view('motor-revision::backend.airports.create', compact('form'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param AirportRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AirportRequest $request)
    {
        $form = $this->form(AirportForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        AirportService::createWithForm($request, $form);

        flash()->success(trans('motor-revision::backend/airports.created'));

        return redirect('backend/airports');
    }


    /**
     * Display the specified resource.
     *
     * @param Airport $record
     */
    public function show(Airport $record)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Airport $record
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Airport $record)
    {
        $form = $this->form(AirportForm::class, [
            'method'  => 'PATCH',
            'url'     => route('backend.airports.update', [ $record->id ]),
            'enctype' => 'multipart/form-data',
            'model'   => $record
        ]);

        return view('motor-revision::backend.airports.edit', compact('form'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param AirportRequest $request
     * @param Airport   $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(AirportRequest $request, Airport $record)
    {
        $form = $this->form(AirportForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        AirportService::updateWithForm($record, $request, $form);

        flash()->success(trans('motor-revision::backend/airports.updated'));

        return redirect('backend/airports');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Airport $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Airport $record)
    {
        AirportService::delete($record);

        flash()->success(trans('motor-revision::backend/airports.deleted'));

        return redirect('backend/airports');
    }
}
