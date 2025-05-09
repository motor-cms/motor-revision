<?php

namespace Motor\Revision\Http\Resources;

use Motor\Backend\Http\Resources\BaseResource;

/**
 * @OA\Schema(
 *   schema="SponsorResource",
 *
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     example="1"
 *   ),
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     example="Super Sponsor Extra"
 *   ),
 *   @OA\Property(
 *     property="level",
 *     type="string",
 *     example="platinum",
 *     description="Options are 'corporate', 'silver', 'gold', 'platinum'",
 *   ),
 *   @OA\Property(
 *     property="url",
 *     type="string",
 *     example="https://www.supersponsor.extra"
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
 *   @OA\Property(
 *     property="text",
 *     type="string",
 *     example="Description of the awesomeness of the sponsor"
 *   ),
 * )
 */
class SponsorResource extends BaseResource
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
            'level' => $this->level,
            'url' => $this->url,
            'sort_position' => (int) $this->sort_position,
            'is_active' => (bool) $this->is_active,
            'text' => $this->text,
        ];
    }
}
