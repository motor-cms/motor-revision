<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\ApiController;

use Motor\Revision\Models\Shuttle;
use Motor\Revision\Http\Requests\Backend\ShuttleRequest;
use Motor\Revision\Services\ShuttleService;
use Motor\Revision\Http\Resources\ShuttleResource;
use Motor\Revision\Http\Resources\ShuttleCollection;

/**
 * Class ShuttlesController
 * @package Motor\Revision\Http\Controllers\Api
 */
class ShuttlesController extends ApiController
{

    protected string $modelResource = 'shuttle';

    /**
     * @OA\Get (
     *   tags={"ShuttlesController"},
     *   path="/api/shuttles",
     *   summary="Get shuttle collection",
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
     *         @OA\Items(ref="#/components/schemas/ShuttleResource")
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
     * @return ShuttleCollection
     */
    public function index()
    {
        $paginator = ShuttleService::collection()->getPaginator();
        return (new ShuttleCollection($paginator))->additional(['message' => 'Shuttle collection read']);
    }

    /**
     * @OA\Post (
     *   tags={"ShuttlesController"},
     *   path="/api/shuttles",
     *   summary="Create new shuttle",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/ShuttleRequest")
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
     *         ref="#/components/schemas/ShuttleResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Shuttle created"
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
     * @param ShuttleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ShuttleRequest $request)
    {
        $result = ShuttleService::create($request)->getResult();
        return (new ShuttleResource($result))->additional(['message' => 'Shuttle created'])->response()->setStatusCode(201);
    }


    /**
     * @OA\Get (
     *   tags={"ShuttlesController"},
     *   path="/api/shuttles/{shuttle}",
     *   summary="Get single shuttle",
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
     *     name="shuttle",
     *     parameter="shuttle",
     *     description="Shuttle id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/ShuttleResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Shuttle read"
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
     * @param Shuttle $record
     * @return ShuttleResource
     */
    public function show(Shuttle $record)
    {
        $result = ShuttleService::show($record)->getResult();
        return (new ShuttleResource($result))->additional(['message' => 'Shuttle read']);
    }


    /**
     * @OA\Put (
     *   tags={"ShuttlesController"},
     *   path="/api/shuttles/{shuttle}",
     *   summary="Update an existing shuttle",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/ShuttleRequest")
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
     *     name="shuttle",
     *     parameter="shuttle",
     *     description="Shuttle id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/ShuttleResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Shuttle updated"
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
     * @param ShuttleRequest $request
     * @param Shuttle        $record
     * @return ShuttleResource
     */
    public function update(ShuttleRequest $request, Shuttle $record)
    {
        $result = ShuttleService::update($record, $request)->getResult();
        return (new ShuttleResource($result))->additional(['message' => 'Shuttle updated']);
    }


    /**
     * @OA\Delete (
     *   tags={"ShuttlesController"},
     *   path="/api/shuttles/{shuttle}",
     *   summary="Delete a shuttle",
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
     *     name="shuttle",
     *     parameter="shuttle",
     *     description="Shuttle id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Shuttle deleted"
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
     *         example="Problem deleting shuttle"
     *       )
     *     )
     *   )
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param Shuttle $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Shuttle $record)
    {
        $result = ShuttleService::delete($record)->getResult();

        if ($result) {
            return response()->json(['message' => 'Shuttle deleted']);
        }
        return response()->json(['message' => 'Problem deleting Shuttle'], 404);
    }
}
