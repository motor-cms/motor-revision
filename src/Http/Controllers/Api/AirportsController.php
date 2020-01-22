<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use Motor\Revision\Models\Airport;
use Motor\Revision\Http\Requests\Backend\AirportRequest;
use Motor\Revision\Services\AirportService;
use Motor\Revision\Transformers\AirportTransformer;

/**
 * Class AirportsController
 * @package Motor\Revision\Http\Controllers\Api
 */
class AirportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginator = AirportService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, AirportTransformer::class);

        return $this->respondWithJson('Airport collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AirportRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AirportRequest $request)
    {
        $result = AirportService::create($request)->getResult();
        $resource = $this->transformItem($result, AirportTransformer::class);

        return $this->respondWithJson('Airport created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param Airport $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Airport $record)
    {
        $result = AirportService::show($record)->getResult();
        $resource = $this->transformItem($result, AirportTransformer::class);

        return $this->respondWithJson('Airport read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param AirportRequest $request
     * @param Airport        $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AirportRequest $request, Airport $record)
    {
        $result = AirportService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, AirportTransformer::class);

        return $this->respondWithJson('Airport updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Airport $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Airport $record)
    {
        $result = AirportService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('Airport deleted', ['success' => true]);
        }
        return $this->respondWithJson('Airport NOT deleted', ['success' => false]);
    }
}