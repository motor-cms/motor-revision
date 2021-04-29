<?php

namespace Motor\Revision\Http\Resources;

use Motor\Backend\Http\Resources\BaseResource;

/**
 * @OA\Schema(
 *   schema="TravelerResource",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     example="1"
 *   ),
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     example="Hans Traveler"
 *   ),
 *   @OA\Property(
 *     property="email",
 *     type="string",
 *     example="hans@traveler.comr"
 *   ),
 *   @OA\Property(
 *     property="mobile_phone",
 *     type="string",
 *     example="+49 123 123123"
 *   ),
 *   @OA\Property(
 *     property="number_of_people",
 *     type="integer",
 *     example="2"
 *   ),
 *   @OA\Property(
 *     property="flight_number",
 *     type="string",
 *     example="LH 512"
 *   ),
 *   @OA\Property(
 *     property="flight_time",
 *     type="datetime",
 *     example="2021-05-01 12:40:00"
 *   ),
 *   @OA\Property(
 *     property="direction",
 *     type="string",
 *     example="Hans Traveler",
 *     description="Options are 'party' and 'airport'"
 *   ),
 *   @OA\Property(
 *     property="shuttle",
 *     type="object",
 *     ref="#/components/schemas/ShuttleResource"
 *   ),
 *   @OA\Property(
 *     property="airport",
 *     type="object",
 *     ref="#/components/schemas/AirportResource"
 *   ),
 * )
 */
class TravelerResource extends BaseResource
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
            'name'             => $this->name,
            'email'            => $this->email,
            'mobile_phone'     => $this->mobile_phone,
            'number_of_people' => $this->number_of_people,
            'flight_number'    => $this->flight_number,
            'flight_time'      => $this->flight_time,
            'direction'        => $this->direction,
            'airport'          => new AirportResource($this->airport),
            'shuttle'          => new ShuttleResource($this->shuttle),
        ];
    }
}
