<?php

namespace Motor\Revision\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use \Motor\Revision\Models\Ticket;
use \Motor\Revision\Http\Requests\Backend\TicketRequest;
use \Motor\Revision\Services\TicketService;
use \Motor\Revision\Transformers\TicketTransformer;

/**
 * Class TicketsController
 * @package Motor\Revision\Http\Controllers\Api
 */
class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginator = TicketService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, TicketTransformer::class);

        return $this->respondWithJson('Ticket collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TicketRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TicketRequest $request)
    {
        $result = TicketService::create($request)->getResult();
        $resource = $this->transformItem($result, TicketTransformer::class);

        return $this->respondWithJson('Ticket created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param Ticket $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Ticket $record)
    {
        $result = TicketService::show($record)->getResult();
        $resource = $this->transformItem($result, TicketTransformer::class);

        return $this->respondWithJson('Ticket read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param TicketRequest $request
     * @param Ticket        $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TicketRequest $request, Ticket $record)
    {
        $result = TicketService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, TicketTransformer::class);

        return $this->respondWithJson('Ticket updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Ticket $record)
    {
        $result = TicketService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('Ticket deleted', ['success' => true]);
        }
        return $this->respondWithJson('Ticket NOT deleted', ['success' => false]);
    }
}