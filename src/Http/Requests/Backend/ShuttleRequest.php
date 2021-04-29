<?php

namespace Motor\Revision\Http\Requests\Backend;

use Motor\Backend\Http\Requests\Request;

/**
 * Class ShuttleRequest
 *
 * @package Motor\Revision\Http\Requests\Backend
 */
class ShuttleRequest extends Request
{
    /**
     * @OA\Schema(
     *   schema="ShuttleRequest",
     *   @OA\Property(
     *     property="airport_id",
     *     type="integer",
     *     example="1"
     *   ),
     *   @OA\Property(
     *     property="name",
     *     type="string",
     *     example="Shuttle FRA #5"
     *   ),
     *   @OA\Property(
     *     property="direction",
     *     type="string",
     *     example="TO",
     *     description="Options are 'party' and 'airport'"
     *   ),
     *   @OA\Property(
     *     property="departs_at",
     *     type="datetime",
     *     example="2021-05-01 12:00:00"
     *   ),
     *   @OA\Property(
     *     property="arrives_at",
     *     type="datetime",
     *     example="2021-05-01 14:30:00"
     *   ),
     *   @OA\Property(
     *     property="travel_time",
     *     type="string",
     *     example="2h30m"
     *   ),
     *   @OA\Property(
     *     property="seats",
     *     type="integer",
     *     example="18"
     *   ),
     *   @OA\Property(
     *     property="price",
     *     type="string",
     *     example="35 EUR"
     *   ),
     *   @OA\Property(
     *     property="is_active",
     *     type="boolean",
     *     example="true"
     *   ),
     *   required={"airport_id", "name", "direction", "departs_at", "arrived_at", "travel_time", "seats", "price"}
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
            'airport_id'  => 'required',
            'name'        => 'required',
            'direction'   => 'required|in:'.implode(',', array_flip(trans('motor-revision::backend/shuttles.directions'))),
            'departs_at'  => 'required',
            'arrives_at'  => 'required',
            'travel_time' => 'required',
            'seats'       => 'required',
            'price'       => 'required',
            'is_active'   => 'nullable|boolean',
        ];
    }
}
