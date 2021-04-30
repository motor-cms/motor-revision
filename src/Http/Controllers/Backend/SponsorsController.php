<?php

namespace Motor\Revision\Http\Controllers\Backend;

use Kris\LaravelFormBuilder\FormBuilderTrait;
use Motor\Backend\Http\Controllers\Controller;
use Motor\Revision\Forms\Backend\SponsorForm;
use Motor\Revision\Grids\SponsorGrid;
use Motor\Revision\Http\Requests\Backend\SponsorRequest;
use Motor\Revision\Models\Sponsor;
use Motor\Revision\Services\SponsorService;

/**
 * Class SponsorsController
 *
 * @package Motor\Revision\Http\Controllers\Backend
 */
class SponsorsController extends Controller
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
        $grid = new SponsorGrid(Sponsor::class);

        $service = SponsorService::collection($grid);
        $grid->setFilter($service->getFilter());
        $paginator = $service->getPaginator();

        return view('motor-revision::backend.sponsors.index', compact('paginator', 'grid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $form = $this->form(SponsorForm::class, [
            'method'  => 'POST',
            'route'   => 'backend.sponsors.store',
            'enctype' => 'multipart/form-data',
        ]);

        $motorShowRightSidebar = true;

        return view('motor-revision::backend.sponsors.create', compact('form', 'motorShowRightSidebar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SponsorRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SponsorRequest $request)
    {
        $form = $this->form(SponsorForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (! $form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        SponsorService::createWithForm($request, $form);

        flash()->success(trans('motor-revision::backend/sponsors.created'));

        return redirect('backend/sponsors');
    }

    /**
     * Display the specified resource.
     *
     * @param Sponsor $record
     */
    public function show(Sponsor $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Sponsor $record
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Sponsor $record)
    {
        $form = $this->form(SponsorForm::class, [
            'method'  => 'PATCH',
            'url'     => route('backend.sponsors.update', [$record->id]),
            'enctype' => 'multipart/form-data',
            'model'   => $record,
        ]);

        $motorShowRightSidebar = true;

        return view('motor-revision::backend.sponsors.edit', compact('form', 'motorShowRightSidebar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SponsorRequest $request
     * @param Sponsor $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SponsorRequest $request, Sponsor $record)
    {
        $form = $this->form(SponsorForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (! $form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        SponsorService::updateWithForm($record, $request, $form);

        flash()->success(trans('motor-revision::backend/sponsors.updated'));

        return redirect('backend/sponsors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sponsor $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Sponsor $record)
    {
        SponsorService::delete($record);

        flash()->success(trans('motor-revision::backend/sponsors.deleted'));

        return redirect('backend/sponsors');
    }
}
