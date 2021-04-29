<?php

namespace Motor\Revision\Http\Requests\Backend;

use Motor\Backend\Http\Requests\Request;

/**
 * Class TicketRequest
 *
 * @package Motor\Revision\Http\Requests\Backend
 */
class TicketRequest extends Request
{
    /**
     * @OA\Schema(
     *   schema="TicketRequest",
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
     *   required={"type", "name", "address", "zip", "city", "country", "email"},
     * )
     */

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'             => 'required|in:'.implode(',', array_flip(trans('motor-revision::backend/tickets.types'))),
            'handle'           => 'nullable',
            'name'             => 'required',
            'address'          => 'required',
            'zip'              => 'required',
            'city'             => 'required',
            'country'          => 'required',
            'company'          => 'nullable',
            'vat_id'           => 'nullable',
            'email'            => 'required',
            'comment'          => 'nullable',
            'internal_comment' => 'nullable',
            'access_key'       => 'nullable',
            'transportation'   => 'nullable',
            'is_anonymous'     => 'nullable|boolean',
            'amount'           => 'nullable|in:'.implode(',', array_flip(trans('motor-revision::backend/tickets.amounts'))),
            'shirt_size'       => 'nullable|in:'.implode(',', array_flip(trans('motor-revision::backend/tickets.shirt_sizes'))),
            'status'           => 'nullable|in:'.implode(',', array_flip(trans('motor-revision::backend/tickets.at_home_stati'))),
        ];
    }
}
