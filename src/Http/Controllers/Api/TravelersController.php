<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\ApiController;

use Motor\Revision\Models\Traveler;
use Motor\Revision\Http\Requests\Backend\TravelerRequest;
use Motor\Revision\Services\TravelerService;
use Motor\Revision\Http\Resources\TravelerResource;
use Motor\Revision\Http\Resources\TravelerCollection;

/**
 * Class TravelersController
 * @package Motor\Revision\Http\Controllers\Api
 */
class TravelersController extends ApiController
{

    protected string $modelResource = 'traveler';

    /**
     * @OA\Get (
     *   tags={"TravelersController"},
     *   path="/api/travelers",
     *   summary="Get traveler collection",
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
     *         @OA\Items(ref="#/components/schemas/TravelerResource")
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
     * @return TravelerCollection
     */
    public function index()
    {
        $paginator = TravelerService::collection()->getPaginator();
        return (new TravelerCollection($paginator))->additional(['message' => 'Traveler collection read']);
    }

    /**
     * @OA\Post (
     *   tags={"TravelersController"},
     *   path="/api/travelers",
     *   summary="Create new traveler",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/TravelerRequest")
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
     *         ref="#/components/schemas/TravelerResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Traveler created"
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
     * @param TravelerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TravelerRequest $request)
    {
        $result = TravelerService::create($request)->getResult();
        return (new TravelerResource($result))->additional(['message' => 'Traveler created'])->response()->setStatusCode(201);
    }


    /**
     * @OA\Get (
     *   tags={"TravelersController"},
     *   path="/api/travelers/{traveler}",
     *   summary="Get single traveler",
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
     *     name="traveler",
     *     parameter="traveler",
     *     description="Traveler id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/TravelerResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Traveler read"
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
     * @param Traveler $record
     * @return TravelerResource
     */
    public function show(Traveler $record)
    {
        $result = TravelerService::show($record)->getResult();
        return (new TravelerResource($result))->additional(['message' => 'Traveler read']);
    }


    /**
     * @OA\Put (
     *   tags={"TravelersController"},
     *   path="/api/travelers/{traveler}",
     *   summary="Update an existing traveler",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/TravelerRequest")
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
     *     name="traveler",
     *     parameter="traveler",
     *     description="Traveler id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/TravelerResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Traveler updated"
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
     * @param TravelerRequest $request
     * @param Traveler        $record
     * @return TravelerResource
     */
    public function update(TravelerRequest $request, Traveler $record)
    {
        $result = TravelerService::update($record, $request)->getResult();
        return (new TravelerResource($result))->additional(['message' => 'Traveler updated']);
    }


    /**
     * @OA\Delete (
     *   tags={"TravelersController"},
     *   path="/api/travelers/{traveler}",
     *   summary="Delete a traveler",
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
     *     name="traveler",
     *     parameter="traveler",
     *     description="Traveler id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Traveler deleted"
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
     *         example="Problem deleting traveler"
     *       )
     *     )
     *   )
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param Traveler $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Traveler $record)
    {
        $result = TravelerService::delete($record)->getResult();

        if ($result) {
            return response()->json(['message' => 'Traveler deleted']);
        }
        return response()->json(['message' => 'Problem deleting Traveler'], 404);
    }
}
