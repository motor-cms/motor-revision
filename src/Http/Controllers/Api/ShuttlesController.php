<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use Motor\Revision\Models\Shuttle;
use Motor\Revision\Http\Requests\Backend\ShuttleRequest;
use Motor\Revision\Services\ShuttleService;
use Motor\Revision\Transformers\ShuttleTransformer;

/**
 * Class ShuttlesController
 * @package Motor\Revision\Http\Controllers\Api
 */
class ShuttlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginator = ShuttleService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, ShuttleTransformer::class);

        return $this->respondWithJson('Shuttle collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ShuttleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ShuttleRequest $request)
    {
        $result = ShuttleService::create($request)->getResult();
        $resource = $this->transformItem($result, ShuttleTransformer::class);

        return $this->respondWithJson('Shuttle created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param Shuttle $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Shuttle $record)
    {
        $result = ShuttleService::show($record)->getResult();
        $resource = $this->transformItem($result, ShuttleTransformer::class);

        return $this->respondWithJson('Shuttle read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ShuttleRequest $request
     * @param Shuttle        $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ShuttleRequest $request, Shuttle $record)
    {
        $result = ShuttleService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, ShuttleTransformer::class);

        return $this->respondWithJson('Shuttle updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Shuttle $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Shuttle $record)
    {
        $result = ShuttleService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('Shuttle deleted', ['success' => true]);
        }
        return $this->respondWithJson('Shuttle NOT deleted', ['success' => false]);
    }
}