<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use Motor\Revision\Models\Sponsor;
use Motor\Revision\Http\Requests\Backend\SponsorRequest;
use Motor\Revision\Services\SponsorService;
use Motor\Revision\Transformers\SponsorTransformer;

/**
 * Class SponsorsController
 * @package Motor\Revision\Http\Controllers\Api
 */
class SponsorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginator = SponsorService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, SponsorTransformer::class);

        return $this->respondWithJson('Sponsor collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SponsorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SponsorRequest $request)
    {
        $result = SponsorService::create($request)->getResult();
        $resource = $this->transformItem($result, SponsorTransformer::class);

        return $this->respondWithJson('Sponsor created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param Sponsor $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Sponsor $record)
    {
        $result = SponsorService::show($record)->getResult();
        $resource = $this->transformItem($result, SponsorTransformer::class);

        return $this->respondWithJson('Sponsor read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param SponsorRequest $request
     * @param Sponsor        $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SponsorRequest $request, Sponsor $record)
    {
        $result = SponsorService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, SponsorTransformer::class);

        return $this->respondWithJson('Sponsor updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Sponsor $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Sponsor $record)
    {
        $result = SponsorService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('Sponsor deleted', ['success' => true]);
        }
        return $this->respondWithJson('Sponsor NOT deleted', ['success' => false]);
    }
}