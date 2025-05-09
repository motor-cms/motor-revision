<?php

namespace Motor\Revision\Http\Resources;

use Motor\Backend\Http\Resources\BaseResource;

/**
 * @OA\Schema(
 *   schema="AirportResource",
 *
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     example="1"
 *   ),
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     example="Frankfurt/Main"
 *   ),
 *   @OA\Property(
 *     property="code",
 *     type="string",
 *     example="FRA"
 *   ),
 *   @OA\Property(
 *     property="sort_position",
 *     type="integer",
 *     example="2"
 *   ),
 *   @OA\Property(
 *     property="is_active",
 *     type="boolean",
 *     example="true"
 *   ),
 * )
 */
class AirportResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'sort_position' => (int) $this->sort_position,
            'is_active' => (bool) $this->is_active,
            'shuttles' => ShuttleResource::collection($this->whenLoaded('shuttles')),
        ];
    }
}
