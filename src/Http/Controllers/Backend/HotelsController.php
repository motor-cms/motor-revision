<?php

namespace Motor\Revision\Http\Controllers\Backend;

use Kris\LaravelFormBuilder\FormBuilderTrait;
use Motor\Backend\Http\Controllers\Controller;
use Motor\Revision\Forms\Backend\HotelForm;
use Motor\Revision\Grids\HotelGrid;
use Motor\Revision\Http\Requests\Backend\HotelRequest;
use Motor\Revision\Models\Hotel;
use Motor\Revision\Services\HotelService;

/**
 * Class HotelsController
 */
class HotelsController extends Controller
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
        $grid = new HotelGrid(Hotel::class);

        $service = HotelService::collection($grid);
        $grid->setFilter($service->getFilter());
        $paginator = $service->getPaginator();

        return view('motor-revision::backend.hotels.index', compact('paginator', 'grid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $form = $this->form(HotelForm::class, [
            'method' => 'POST',
            'route' => 'backend.hotels.store',
            'enctype' => 'multipart/form-data',
        ]);

        return view('motor-revision::backend.hotels.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(HotelRequest $request)
    {
        $form = $this->form(HotelForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (! $form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        HotelService::createWithForm($request, $form);

        flash()->success(trans('motor-revision::backend/hotels.created'));

        return redirect('backend/hotels');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Hotel $record)
    {
        $form = $this->form(HotelForm::class, [
            'method' => 'PATCH',
            'url' => route('backend.hotels.update', [$record->id]),
            'enctype' => 'multipart/form-data',
            'model' => $record,
        ]);

        return view('motor-revision::backend.hotels.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(HotelRequest $request, Hotel $record)
    {
        $form = $this->form(HotelForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (! $form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        HotelService::updateWithForm($record, $request, $form);

        flash()->success(trans('motor-revision::backend/hotels.updated'));

        return redirect('backend/hotels');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Hotel $record)
    {
        HotelService::delete($record);

        flash()->success(trans('motor-revision::backend/hotels.deleted'));

        return redirect('backend/hotels');
    }
}
