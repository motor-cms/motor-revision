<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use Motor\Revision\Models\Ride;
use Motor\Revision\Http\Requests\Backend\RideRequest;
use Motor\Revision\Services\RideService;
use Motor\Revision\Transformers\RideTransformer;

/**
 * Class RidesController
 * @package Motor\Revision\Http\Controllers\Api
 */
class RidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginator = RideService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, RideTransformer::class);

        return $this->respondWithJson('Ride collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RideRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RideRequest $request)
    {
        $result = RideService::create($request)->getResult();
        $resource = $this->transformItem($result, RideTransformer::class);

        return $this->respondWithJson('Ride created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param Ride $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Ride $record)
    {
        $result = RideService::show($record)->getResult();
        $resource = $this->transformItem($result, RideTransformer::class);

        return $this->respondWithJson('Ride read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param RideRequest $request
     * @param Ride        $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RideRequest $request, Ride $record)
    {
        $result = RideService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, RideTransformer::class);

        return $this->respondWithJson('Ride updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Ride $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Ride $record)
    {
        $result = RideService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('Ride deleted', ['success' => true]);
        }
        return $this->respondWithJson('Ride NOT deleted', ['success' => false]);
    }
}