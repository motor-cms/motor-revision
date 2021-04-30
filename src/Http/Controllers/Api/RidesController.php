<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\ApiController;

use Motor\Revision\Models\Ride;
use Motor\Revision\Http\Requests\Backend\RideRequest;
use Motor\Revision\Services\RideService;
use Motor\Revision\Http\Resources\RideResource;
use Motor\Revision\Http\Resources\RideCollection;

/**
 * Class RidesController
 *
 * @package Motor\Revision\Http\Controllers\Api
 */
class RidesController extends ApiController
{
    protected string $model = 'Motor\Revision\Models\Ride';

    protected string $modelResource = 'ride';

    /**
     * @OA\Get (
     *   tags={"RidesController"},
     *   path="/api/rides",
     *   summary="Get ride collection",
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
     *         @OA\Items(ref="#/components/schemas/RideResource")
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
     * @return RideCollection
     */
    public function index()
    {
        $paginator = RideService::collection()
                                ->getPaginator();

        return (new RideCollection($paginator))->additional(['message' => 'Ride collection read']);
    }

    /**
     * @OA\Post (
     *   tags={"RidesController"},
     *   path="/api/rides",
     *   summary="Create new ride",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/RideRequest")
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
     *         ref="#/components/schemas/RideResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Ride created"
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
     * @param RideRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RideRequest $request)
    {
        $result = RideService::create($request)
                             ->getResult();

        return (new RideResource($result))->additional(['message' => 'Ride created'])
                                          ->response()
                                          ->setStatusCode(201);
    }

    /**
     * @OA\Get (
     *   tags={"RidesController"},
     *   path="/api/rides/{ride}",
     *   summary="Get single ride",
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
     *     name="ride",
     *     parameter="ride",
     *     description="Ride id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/RideResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Ride read"
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
     * @param Ride $record
     * @return RideResource
     */
    public function show(Ride $record)
    {
        $result = RideService::show($record)
                             ->getResult();

        return (new RideResource($result))->additional(['message' => 'Ride read']);
    }

    /**
     * @OA\Put (
     *   tags={"RidesController"},
     *   path="/api/rides/{ride}",
     *   summary="Update an existing ride",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/RideRequest")
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
     *     name="ride",
     *     parameter="ride",
     *     description="Ride id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/RideResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Ride updated"
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
     * @param RideRequest $request
     * @param Ride $record
     * @return RideResource
     */
    public function update(RideRequest $request, Ride $record)
    {
        $result = RideService::update($record, $request)
                             ->getResult();

        return (new RideResource($result))->additional(['message' => 'Ride updated']);
    }

    /**
     * @OA\Delete (
     *   tags={"RidesController"},
     *   path="/api/rides/{ride}",
     *   summary="Delete a ride",
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
     *     name="ride",
     *     parameter="ride",
     *     description="Ride id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Ride deleted"
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
     *         example="Problem deleting ride"
     *       )
     *     )
     *   )
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param Ride $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Ride $record)
    {
        $result = RideService::delete($record)
                             ->getResult();

        if ($result) {
            return response()->json(['message' => 'Ride deleted']);
        }

        return response()->json(['message' => 'Problem deleting Ride'], 404);
    }
}
