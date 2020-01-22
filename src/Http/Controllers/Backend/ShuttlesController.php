<?php

namespace Motor\Revision\Http\Controllers\Backend;

use Motor\Backend\Http\Controllers\Controller;

use Motor\Revision\Models\Shuttle;
use Motor\Revision\Http\Requests\Backend\ShuttleRequest;
use Motor\Revision\Services\ShuttleService;
use Motor\Revision\Grids\ShuttleGrid;
use Motor\Revision\Forms\Backend\ShuttleForm;
use Kris\LaravelFormBuilder\FormBuilderTrait;

/**
 * Class ShuttlesController
 * @package Motor\Revision\Http\Controllers\Backend
 */
class ShuttlesController extends Controller
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
        $grid = new ShuttleGrid(Shuttle::class);

        $service = ShuttleService::collection($grid);
        $grid->setFilter($service->getFilter());
        $paginator = $service->getPaginator();

        return view('motor-revision::backend.shuttles.index', compact('paginator', 'grid'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->form(ShuttleForm::class, [
            'method'  => 'POST',
            'route'   => 'backend.shuttles.store',
            'enctype' => 'multipart/form-data'
        ]);

        return view('motor-revision::backend.shuttles.create', compact('form'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ShuttleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ShuttleRequest $request)
    {
        $form = $this->form(ShuttleForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        ShuttleService::createWithForm($request, $form);

        flash()->success(trans('motor-revision::backend/shuttles.created'));

        return redirect('backend/shuttles');
    }


    /**
     * Display the specified resource.
     *
     * @param Shuttle $record
     */
    public function show(Shuttle $record)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Shuttle $record
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Shuttle $record)
    {
        $form = $this->form(ShuttleForm::class, [
            'method'  => 'PATCH',
            'url'     => route('backend.shuttles.update', [ $record->id ]),
            'enctype' => 'multipart/form-data',
            'model'   => $record
        ]);

        return view('motor-revision::backend.shuttles.edit', compact('form'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ShuttleRequest $request
     * @param Shuttle   $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ShuttleRequest $request, Shuttle $record)
    {
        $form = $this->form(ShuttleForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        ShuttleService::updateWithForm($record, $request, $form);

        flash()->success(trans('motor-revision::backend/shuttles.updated'));

        return redirect('backend/shuttles');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Shuttle $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Shuttle $record)
    {
        ShuttleService::delete($record);

        flash()->success(trans('motor-revision::backend/shuttles.deleted'));

        return redirect('backend/shuttles');
    }
}
