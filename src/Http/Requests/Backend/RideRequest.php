<?php

namespace Motor\Revision\Http\Requests\Backend;

use Motor\Backend\Http\Requests\Request;

/**
 * Class RideRequest
 *
 * @package Motor\Revision\Http\Requests\Backend
 */
class RideRequest extends Request
{
    /**
     * @OA\Schema(
     *   schema="RideRequest",
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
     *   required={"direction", "type", "means_of_transportation", "name", "email", "country"},
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
            'direction'               => 'required|in:'.implode(',', trans('motor-revision::backend/rides.directions')),
            'type'                    => 'required|in:'.implode(',', trans('motor-revision::backend/rides.types')),
            'means_of_transportation' => 'required',
            'name'                    => 'required',
            'email'                   => 'required|email',
            'country'                 => 'required',
            'route'                   => 'nullable',
        ];
    }
}
