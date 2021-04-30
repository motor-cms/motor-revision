<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\ApiController;

use Motor\Revision\Models\Hotel;
use Motor\Revision\Http\Requests\Backend\HotelRequest;
use Motor\Revision\Services\HotelService;
use Motor\Revision\Http\Resources\HotelResource;
use Motor\Revision\Http\Resources\HotelCollection;

/**
 * Class HotelsController
 *
 * @package Motor\Revision\Http\Controllers\Api
 */
class HotelsController extends ApiController
{
    protected string $model = 'Motor\Revision\Models\Hotel';

    protected string $modelResource = 'hotel';

    /**
     * @OA\Get (
     *   tags={"HotelsController"},
     *   path="/api/hotels",
     *   summary="Get hotel collection",
     *   @OA\Parameter(
     *     @OA\Schema(type="string"),
     *     in="query",
     *     allowReserved=true,
     *     name="api_token",
     *     parameter="api_token",
     *     description="Personal api_token of the user"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/HotelResource")
     *       ),
     *       @OA\Property(
     *         property="meta",
     *         ref="#/components/schemas/PaginationMeta"
     *       ),
     *       @OA\Property(
     *         property="links",
     *         ref="#/components/schemas/PaginationLinks"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Collection read"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="403",
     *     description="Access denied",
     *     @OA\JsonContent(ref="#/components/schemas/AccessDenied"),
     *   )
     * )
     *
     * Display a listing of the resource.
     *
     * @return HotelCollection
     */
    public function index()
    {
        $paginator = HotelService::collection()
                                 ->getPaginator();

        return (new HotelCollection($paginator))->additional(['message' => 'Hotel collection read']);
    }

    /**
     * @OA\Post (
     *   tags={"HotelsController"},
     *   path="/api/hotels",
     *   summary="Create new hotel",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/HotelRequest")
     *   ),
     *   @OA\Parameter(
     *     @OA\Schema(type="string"),
     *     in="query",
     *     allowReserved=true,
     *     name="api_token",
     *     parameter="api_token",
     *     description="Personal api_token of the user"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/HotelResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Hotel created"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="403",
     *     description="Access denied",
     *     @OA\JsonContent(ref="#/components/schemas/AccessDenied"),
     *   ),
     *   @OA\Response(
     *     response="404",
     *     description="Not found",
     *     @OA\JsonContent(ref="#/components/schemas/NotFound"),
     *   )
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param HotelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(HotelRequest $request)
    {
        $result = HotelService::create($request)
                              ->getResult();

        return (new HotelResource($result))->additional(['message' => 'Hotel created'])
                                           ->response()
                                           ->setStatusCode(201);
    }

    /**
     * @OA\Get (
     *   tags={"HotelsController"},
     *   path="/api/hotels/{hotel}",
     *   summary="Get single hotel",
     *   @OA\Parameter(
     *     @OA\Schema(type="string"),
     *     in="query",
     *     allowReserved=true,
     *     name="api_token",
     *     parameter="api_token",
     *     description="Personal api_token of the user"
     *   ),
     *   @OA\Parameter(
     *     @OA\Schema(type="integer"),
     *     in="path",
     *     name="hotel",
     *     parameter="hotel",
     *     description="Hotel id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/HotelResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Hotel read"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="403",
     *     description="Access denied",
     *     @OA\JsonContent(ref="#/components/schemas/AccessDenied"),
     *   ),
     *   @OA\Response(
     *     response="404",
     *     description="Not found",
     *     @OA\JsonContent(ref="#/components/schemas/NotFound"),
     *   )
     * )
     *
     * Display the specified resource.
     *
     * @param Hotel $record
     * @return HotelResource
     */
    public function show(Hotel $record)
    {
        $result = HotelService::show($record)
                              ->getResult();

        return (new HotelResource($result))->additional(['message' => 'Hotel read']);
    }

    /**
     * @OA\Put (
     *   tags={"HotelsController"},
     *   path="/api/hotels/{hotel}",
     *   summary="Update an existing hotel",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/HotelRequest")
     *   ),
     *   @OA\Parameter(
     *     @OA\Schema(type="string"),
     *     in="query",
     *     allowReserved=true,
     *     name="api_token",
     *     parameter="api_token",
     *     description="Personal api_token of the user"
     *   ),
     *   @OA\Parameter(
     *     @OA\Schema(type="integer"),
     *     in="path",
     *     name="hotel",
     *     parameter="hotel",
     *     description="Hotel id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/HotelResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Hotel updated"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="403",
     *     description="Access denied",
     *     @OA\JsonContent(ref="#/components/schemas/AccessDenied"),
     *   ),
     *   @OA\Response(
     *     response="404",
     *     description="Not found",
     *     @OA\JsonContent(ref="#/components/schemas/NotFound"),
     *   )
     * )
     *
     * Update the specified resource in storage.
     *
     * @param HotelRequest $request
     * @param Hotel $record
     * @return HotelResource
     */
    public function update(HotelRequest $request, Hotel $record)
    {
        $result = HotelService::update($record, $request)
                              ->getResult();

        return (new HotelResource($result))->additional(['message' => 'Hotel updated']);
    }

    /**
     * @OA\Delete (
     *   tags={"HotelsController"},
     *   path="/api/hotels/{hotel}",
     *   summary="Delete a hotel",
     *   @OA\Parameter(
     *     @OA\Schema(type="string"),
     *     in="query",
     *     allowReserved=true,
     *     name="api_token",
     *     parameter="api_token",
     *     description="Personal api_token of the user"
     *   ),
     *   @OA\Parameter(
     *     @OA\Schema(type="integer"),
     *     in="path",
     *     name="hotel",
     *     parameter="hotel",
     *     description="Hotel id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Hotel deleted"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="403",
     *     description="Access denied",
     *     @OA\JsonContent(ref="#/components/schemas/AccessDenied"),
     *   ),
     *   @OA\Response(
     *     response="404",
     *     description="Not found",
     *     @OA\JsonContent(ref="#/components/schemas/NotFound"),
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Bad request",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Problem deleting hotel"
     *       )
     *     )
     *   )
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param Hotel $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Hotel $record)
    {
        $result = HotelService::delete($record)
                              ->getResult();

        if ($result) {
            return response()->json(['message' => 'Hotel deleted']);
        }

        return response()->json(['message' => 'Problem deleting Hotel'], 404);
    }
}
