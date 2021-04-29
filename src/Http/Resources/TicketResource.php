<?php

namespace Motor\Revision\Http\Resources;

use Motor\Backend\Http\Resources\BaseResource;

/**
 * @OA\Schema(
 *   schema="TicketResource",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     example="1"
 *   ),
 *   @OA\Property(
 *     property="type",
 *     type="string",
 *     example="supporter",
 *   ),
 *   @OA\Property(
 *     property="handle",
 *     type="string",
 *     example="AwesomePerson^GreatGroup",
 *   ),
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     example="Ivana Ticket",
 *   ),
 *   @OA\Property(
 *     property="address",
 *     type="string",
 *     example="123 Ticket Lane",
 *   ),
 *   @OA\Property(
 *     property="zip",
 *     type="string",
 *     example="12345",
 *   ),
 *   @OA\Property(
 *     property="city",
 *     type="string",
 *     example="Ticketdorf",
 *   ),
 *   @OA\Property(
 *     property="country",
 *     type="string",
 *     example="Germany",
 *   ),
 *   @OA\Property(
 *     property="company",
 *     type="string",
 *     example="Ivana Ticket Ltd.",
 *   ),
 *   @OA\Property(
 *     property="vat_id",
 *     type="string",
 *     example="DE1020304050",
 *   ),
 *   @OA\Property(
 *     property="email",
 *     type="string",
 *     example="ivana@ticket.de",
 *   ),
 *   @OA\Property(
 *     property="comment",
 *     type="string",
 *     example="This is why I want this ticket",
 *   ),
 *   @OA\Property(
 *     property="internal_comment",
 *     type="string",
 *     example="This is why he person will get the ticket",
 *   ),
 *   @OA\Property(
 *     property="access_key",
 *     type="string",
 *     example="REVI-SION",
 *   ),
 *   @OA\Property(
 *     property="transportation",
 *     type="string",
 *     example="Description of the means of transportation",
 *   ),
 *   @OA\Property(
 *     property="is_anonymous",
 *     type="boolean",
 *     example="false",
 *   ),
 *   @OA\Property(
 *     property="amount",
 *     type="string",
 *     example="750 EUR",
 *   ),
 *   @OA\Property(
 *     property="shirt_size",
 *     type="string",
 *     example="Girly M",
 *   ),
 *   @OA\Property(
 *     property="status",
 *     type="integer",
 *     example="1",
 *   ),
 * )
 */
class TicketResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'               => (int) $this->id,
            'type'             => $this->type,
            'handle'           => $this->handle,
            'name'             => $this->name,
            'address'          => $this->address,
            'zip'              => $this->zip,
            'city'             => $this->city,
            'country'          => $this->country,
            'company'          => $this->company,
            'vat_id'           => $this->vat_id,
            'email'            => $this->email,
            'comment'          => $this->comment,
            'internal_comment' => $this->internal_comment,
            'access_key'       => $this->access_key,
            'transportation'   => $this->transportation,
            'is_anonymous'     => (boolean) $this->is_anonymous,
            'amount'           => $this->amount,
            'shirt_size'       => $this->shirt_size,
            'status'           => (int) $this->status,
        ];
    }
}
