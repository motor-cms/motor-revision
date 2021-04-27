<?php

namespace Motor\Revision\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   schema="ShuttleResource",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     example="1"
 *   ),
 *   @OA\Property(
 *     property="airport",
 *     type="object",
 *     ref="#/components/schemas/AirportResource"
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
 * )
 */
class ShuttleResource extends JsonResource
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
            'id'          => (int) $this->id,
            'airport'     => new AirportResource($this->airport),
            'name'        => $this->name,
            'direction'   => $this->direction,
            'departs_at'  => $this->departs_at,
            'arrives_at'  => $this->arrives_at,
            'travel_time' => $this->travel_time,
            'seats'       => $this->seats,
            'price'       => $this->price,
            'is_active'   => (boolean) $this->is_active,
            'travelers'   => TravelerResource::collection($this->whenLoaded('travelers')),
        ];
    }
}
