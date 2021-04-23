<?php

namespace Motor\Revision\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   schema="RideResource",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     example="1"
 *   ),
 *   @OA\Property(
 *     property="direction",
 *     type="string",
 *     example="TO",
 *     description="Options are 'TO' and 'FROM'"
 *   ),
 *   @OA\Property(
 *     property="type",
 *     type="string",
 *     example="seek",
 *     description="Options are 'offer' and 'seek'"
 *   ),
 *   @OA\Property(
 *     property="means_of_transportation",
 *     type="string",
 *     example="Car"
 *   ),
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     example="Ridey McRideface"
 *   ),
 *   @OA\Property(
 *     property="email",
 *     type="string",
 *     example="ridey@mcrideface.com"
 *   ),
 *   @OA\Property(
 *     property="country",
 *     type="string",
 *     example="Germany"
 *   ),
 *   @OA\Property(
 *     property="route",
 *     type="string",
 *     example="Over the hills and far away"
 *   ),
 * )
 */
class RideResource extends JsonResource
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
            'id'                      => (int) $this->id,
            'direction'               => $this->direction,
            'type'                    => $this->type,
            'means_of_transportation' => $this->means_of_transportation,
            'name'                    => $this->name,
            'email'                   => $this->email,
            'country'                 => $this->country,
            'route'                   => $this->route,
        ];
    }
}
