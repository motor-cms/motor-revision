<?php

namespace Motor\Revision\Http\Requests\Backend;

use Motor\Backend\Http\Requests\Request;

/**
 * Class TravelerRequest
 */
class TravelerRequest extends Request
{
    /**
     * @OA\Schema(
     *   schema="TravelerRequest",
     *
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
     *     property="shuttle_id",
     *     type="integer",
     *     example="2"
     *   ),
     *   @OA\Property(
     *     property="airport_id",
     *     type="integer",
     *     example="1"
     *   ),
     *   required={"name", "email", "mobile_phone", "number_of_people", "flight_number", "flight_time", "direction", "airport_id"},
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
            'name' => 'required',
            'email' => 'required|email',
            'mobile_phone' => 'required',
            'number_of_people' => 'required|integer',
            'flight_number' => 'required',
            'flight_time' => 'required|date_format:Y-m-d H:i:s',
            'direction' => 'required|in:'.implode(',', array_flip(trans('motor-revision::backend/shuttles.directions'))),
            'shuttle_id' => 'nullable|integer|exists:shuttles,id',
            'airport_id' => 'required|integer|exists:airports,id',
        ];
    }
}
