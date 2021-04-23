<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\ApiController;

use Motor\Revision\Models\Ticket;
use Motor\Revision\Http\Requests\Backend\TicketRequest;
use Motor\Revision\Services\TicketService;
use Motor\Revision\Http\Resources\TicketResource;
use Motor\Revision\Http\Resources\TicketCollection;

/**
 * Class TicketsController
 * @package Motor\Revision\Http\Controllers\Api
 */
class TicketsController extends ApiController
{

    protected string $modelResource = 'ticket';

    /**
     * @OA\Get (
     *   tags={"TicketsController"},
     *   path="/api/tickets",
     *   summary="Get ticket collection",
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
     *         @OA\Items(ref="#/components/schemas/TicketResource")
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
     * @return TicketCollection
     */
    public function index()
    {
        $paginator = TicketService::collection()->getPaginator();
        return (new TicketCollection($paginator))->additional(['message' => 'Ticket collection read']);
    }

    /**
     * @OA\Post (
     *   tags={"TicketsController"},
     *   path="/api/tickets",
     *   summary="Create new ticket",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/TicketRequest")
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
     *         ref="#/components/schemas/TicketResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Ticket created"
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
     * @param TicketRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TicketRequest $request)
    {
        $result = TicketService::create($request)->getResult();
        return (new TicketResource($result))->additional(['message' => 'Ticket created'])->response()->setStatusCode(201);
    }


    /**
     * @OA\Get (
     *   tags={"TicketsController"},
     *   path="/api/tickets/{ticket}",
     *   summary="Get single ticket",
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
     *     name="ticket",
     *     parameter="ticket",
     *     description="Ticket id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/TicketResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Ticket read"
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
     * @param Ticket $record
     * @return TicketResource
     */
    public function show(Ticket $record)
    {
        $result = TicketService::show($record)->getResult();
        return (new TicketResource($result))->additional(['message' => 'Ticket read']);
    }


    /**
     * @OA\Put (
     *   tags={"TicketsController"},
     *   path="/api/tickets/{ticket}",
     *   summary="Update an existing ticket",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/TicketRequest")
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
     *     name="ticket",
     *     parameter="ticket",
     *     description="Ticket id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/TicketResource"
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Ticket updated"
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
     * @param TicketRequest $request
     * @param Ticket        $record
     * @return TicketResource
     */
    public function update(TicketRequest $request, Ticket $record)
    {
        $result = TicketService::update($record, $request)->getResult();
        return (new TicketResource($result))->additional(['message' => 'Ticket updated']);
    }


    /**
     * @OA\Delete (
     *   tags={"TicketsController"},
     *   path="/api/tickets/{ticket}",
     *   summary="Delete a ticket",
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
     *     name="ticket",
     *     parameter="ticket",
     *     description="Ticket id"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Ticket deleted"
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
     *         example="Problem deleting ticket"
     *       )
     *     )
     *   )
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param Ticket $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Ticket $record)
    {
        $result = TicketService::delete($record)->getResult();

        if ($result) {
            return response()->json(['message' => 'Ticket deleted']);
        }
        return response()->json(['message' => 'Problem deleting Ticket'], 404);
    }
}
