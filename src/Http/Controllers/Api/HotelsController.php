<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use Motor\Revision\Models\Hotel;
use Motor\Revision\Http\Requests\Backend\HotelRequest;
use Motor\Revision\Services\HotelService;
use Motor\Revision\Transformers\HotelTransformer;

/**
 * Class HotelsController
 * @package Motor\Revision\Http\Controllers\Api
 */
class HotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginator = HotelService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, HotelTransformer::class);

        return $this->respondWithJson('Hotel collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HotelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(HotelRequest $request)
    {
        $result = HotelService::create($request)->getResult();
        $resource = $this->transformItem($result, HotelTransformer::class);

        return $this->respondWithJson('Hotel created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param Hotel $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Hotel $record)
    {
        $result = HotelService::show($record)->getResult();
        $resource = $this->transformItem($result, HotelTransformer::class);

        return $this->respondWithJson('Hotel read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param HotelRequest $request
     * @param Hotel        $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(HotelRequest $request, Hotel $record)
    {
        $result = HotelService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, HotelTransformer::class);

        return $this->respondWithJson('Hotel updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Hotel $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Hotel $record)
    {
        $result = HotelService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('Hotel deleted', ['success' => true]);
        }
        return $this->respondWithJson('Hotel NOT deleted', ['success' => false]);
    }
}