<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use Motor\Revision\Models\Traveler;
use Motor\Revision\Http\Requests\Backend\TravelerRequest;
use Motor\Revision\Services\TravelerService;
use Motor\Revision\Transformers\TravelerTransformer;

/**
 * Class TravelersController
 * @package Motor\Revision\Http\Controllers\Api
 */
class TravelersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginator = TravelerService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, TravelerTransformer::class);

        return $this->respondWithJson('Traveler collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TravelerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TravelerRequest $request)
    {
        $result = TravelerService::create($request)->getResult();
        $resource = $this->transformItem($result, TravelerTransformer::class);

        return $this->respondWithJson('Traveler created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param Traveler $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Traveler $record)
    {
        $result = TravelerService::show($record)->getResult();
        $resource = $this->transformItem($result, TravelerTransformer::class);

        return $this->respondWithJson('Traveler read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param TravelerRequest $request
     * @param Traveler        $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TravelerRequest $request, Traveler $record)
    {
        $result = TravelerService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, TravelerTransformer::class);

        return $this->respondWithJson('Traveler updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Traveler $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Traveler $record)
    {
        $result = TravelerService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('Traveler deleted', ['success' => true]);
        }
        return $this->respondWithJson('Traveler NOT deleted', ['success' => false]);
    }
}