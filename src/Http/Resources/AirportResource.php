<?php

namespace Motor\Revision\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   schema="AirportResource",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     example="1"
 *   )
 * )
 */

class AirportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
