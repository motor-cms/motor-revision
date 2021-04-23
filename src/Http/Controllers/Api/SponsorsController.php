<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\ApiController;

use Motor\Revision\Models\Sponsor;
use Motor\Revision\Http\Requests\Backend\SponsorRequest;
use Motor\Revision\Services\SponsorService;
use Motor\Revision\Http\Resources\SponsorResource;
use Motor\Revision\Http\Resources\SponsorCollection;

/**
 * Class SponsorsController
 * @package Motor\Revision\Http\Controllers\Api
 */
class SponsorsController extends ApiController
{

    protected string $modelResource = 'sponsor';

    /**
     * @OA\Get (
     *   tags={"SponsorsController"},
     *   path="/api/sponsors",
     *   summary="Get sponsor collection",
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
     *         @OA\Items(ref="#/components/schemas/SponsorResource")
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
     * @return SponsorCollection
     */
    public function index()
    {
        $paginator = SponsorService::collection()->getPaginator();
        return (new SponsorCollection($paginator))->additional(['message' => 'Sponsor collection read']);
    }

    /**
     * @OA\Post (
     *   tags={"SponsorsController"},
     *   path="/api/sponsors",
     *   summary="Create new sponsor",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/SponsorRequest")
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
     *         ref="#/components/schemas/SponsorResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Sponsor created"
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
     * @param SponsorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SponsorRequest $request)
    {
        $result = SponsorService::create($request)->getResult();
        return (new SponsorResource($result))->additional(['message' => 'Sponsor created'])->response()->setStatusCode(201);
    }


    /**
     * @OA\Get (
     *   tags={"SponsorsController"},
     *   path="/api/sponsors/{sponsor}",
     *   summary="Get single sponsor",
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
     *     name="sponsor",
     *     parameter="sponsor",
     *     description="Sponsor id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/SponsorResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Sponsor read"
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
     * @param Sponsor $record
     * @return SponsorResource
     */
    public function show(Sponsor $record)
    {
        $result = SponsorService::show($record)->getResult();
        return (new SponsorResource($result))->additional(['message' => 'Sponsor read']);
    }


    /**
     * @OA\Put (
     *   tags={"SponsorsController"},
     *   path="/api/sponsors/{sponsor}",
     *   summary="Update an existing sponsor",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/SponsorRequest")
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
     *     name="sponsor",
     *     parameter="sponsor",
     *     description="Sponsor id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/SponsorResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Sponsor updated"
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
     * @param SponsorRequest $request
     * @param Sponsor        $record
     * @return SponsorResource
     */
    public function update(SponsorRequest $request, Sponsor $record)
    {
        $result = SponsorService::update($record, $request)->getResult();
        return (new SponsorResource($result))->additional(['message' => 'Sponsor updated']);
    }


    /**
     * @OA\Delete (
     *   tags={"SponsorsController"},
     *   path="/api/sponsors/{sponsor}",
     *   summary="Delete a sponsor",
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
     *     name="sponsor",
     *     parameter="sponsor",
     *     description="Sponsor id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Sponsor deleted"
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
     *         example="Problem deleting sponsor"
     *       )
     *     )
     *   )
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param Sponsor $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Sponsor $record)
    {
        $result = SponsorService::delete($record)->getResult();

        if ($result) {
            return response()->json(['message' => 'Sponsor deleted']);
        }
        return response()->json(['message' => 'Problem deleting Sponsor'], 404);
    }
}
