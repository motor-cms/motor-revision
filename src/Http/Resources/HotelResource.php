<?php

namespace Motor\Revision\Http\Resources;

use Motor\Backend\Http\Resources\BaseResource;

/**
 * @OA\Schema(
 *   schema="HotelResource",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     example="1"
 *   ),
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     example="Mega Hotel"
 *   ),
 *   @OA\Property(
 *     property="short",
 *     type="string",
 *     example="01"
 *   ),
 *   @OA\Property(
 *     property="description",
 *     type="string",
 *     example="Description of the hotel in great detail"
 *   ),
 *   @OA\Property(
 *     property="address",
 *     type="string",
 *     example="1234 Hotel Street, 12345 Berlin, Germany"
 *   ),
 *   @OA\Property(
 *     property="email",
 *     type="string",
 *     example="concierge@mygreathotel.com"
 *   ),
 *   @OA\Property(
 *     property="website",
 *     type="string",
 *     example="https://www.mygreathotel.com"
 *   ),
 *   @OA\Property(
 *     property="latitude",
 *     type="string",
 *     example="49.12345"
 *   ),
 *   @OA\Property(
 *     property="longitude",
 *     type="string",
 *     example="7.98765"
 *   ),
 *   @OA\Property(
 *     property="rating",
 *     type="integer",
 *     example="5"
 *   ),
 *   @OA\Property(
 *     property="is_active",
 *     type="boolean",
 *     example="true"
 *   ),
 * )
 */
class HotelResource extends BaseResource
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
            'name'        => $this->name,
            'short'       => $this->short,
            'description' => $this->description,
            'address'     => $this->address,
            'email'       => $this->email,
            'website'     => $this->website,
            'latitude'    => $this->latitude,
            'longitude'   => $this->longitude,
            'rating'      => (int) $this->rating,
            'is_active'   => (boolean) $this->is_active,
        ];
    }
}
