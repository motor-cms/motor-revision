<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\ApiController;

use Motor\Revision\Models\Airport;
use Motor\Revision\Http\Requests\Backend\AirportRequest;
use Motor\Revision\Services\AirportService;
use Motor\Revision\Http\Resources\AirportResource;
use Motor\Revision\Http\Resources\AirportCollection;

/**
 * Class AirportsController
 * @package Motor\Revision\Http\Controllers\Api
 */
class AirportsController extends ApiController
{

    protected string $modelResource = 'airport';

    /**
     * @OA\Get (
     *   tags={"AirportsController"},
     *   path="/api/airports",
     *   summary="Get airport collection",
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
     *         @OA\Items(ref="#/components/schemas/AirportResource")
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
     * @return AirportCollection
     */
    public function index()
    {
        $paginator = AirportService::collection()->getPaginator();
        return (new AirportCollection($paginator))->additional(['message' => 'Airport collection read']);
    }

    /**
     * @OA\Post (
     *   tags={"AirportsController"},
     *   path="/api/airports",
     *   summary="Create new airport",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/AirportRequest")
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
     *         ref="#/components/schemas/AirportResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Airport created"
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
     * @param AirportRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AirportRequest $request)
    {
        $result = AirportService::create($request)->getResult();
        return (new AirportResource($result))->additional(['message' => 'Airport created'])->response()->setStatusCode(201);
    }


    /**
     * @OA\Get (
     *   tags={"AirportsController"},
     *   path="/api/airports/{airport}",
     *   summary="Get single airport",
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
     *     name="airport",
     *     parameter="airport",
     *     description="Airport id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/AirportResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Airport read"
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
     * @param Airport $record
     * @return AirportResource
     */
    public function show(Airport $record)
    {
        $result = AirportService::show($record)->getResult();
        return (new AirportResource($result))->additional(['message' => 'Airport read']);
    }


    /**
     * @OA\Put (
     *   tags={"AirportsController"},
     *   path="/api/airports/{airport}",
     *   summary="Update an existing airport",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/AirportRequest")
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
     *     name="airport",
     *     parameter="airport",
     *     description="Airport id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/AirportResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Airport updated"
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
     * @param AirportRequest $request
     * @param Airport        $record
     * @return AirportResource
     */
    public function update(AirportRequest $request, Airport $record)
    {
        $result = AirportService::update($record, $request)->getResult();
        return (new AirportResource($result))->additional(['message' => 'Airport updated']);
    }


    /**
     * @OA\Delete (
     *   tags={"AirportsController"},
     *   path="/api/airports/{airport}",
     *   summary="Delete a airport",
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
     *     name="airport",
     *     parameter="airport",
     *     description="Airport id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Airport deleted"
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
     *         example="Problem deleting airport"
     *       )
     *     )
     *   )
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param Airport $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Airport $record)
    {
        $result = AirportService::delete($record)->getResult();

        if ($result) {
            return response()->json(['message' => 'Airport deleted']);
        }
        return response()->json(['message' => 'Problem deleting Airport'], 404);
    }
}
