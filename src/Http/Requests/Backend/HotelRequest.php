<?php

namespace Motor\Revision\Http\Requests\Backend;

use Motor\Backend\Http\Requests\Request;

/**
 * Class HotelRequest
 *
 * @package Motor\Revision\Http\Requests\Backend
 */
class HotelRequest extends Request
{
    /**
     * @OA\Schema(
     *   schema="HotelRequest",
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
     *     type="text",
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
     *   required={"name", "short"},
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
            'short'       => 'required',
            'name'        => 'required',
            'description' => 'nullable',
            'address'     => 'required',
            'email'       => 'nullable|email',
            'website'     => 'nullable',
            'latitude'    => 'nullable',
            'longitude'   => 'nullable',
            'rating'      => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ];
    }
}
