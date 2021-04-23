<?php

namespace Motor\Revision\Http\Requests\Backend;

use Motor\Backend\Http\Requests\Request;

/**
 * Class AirportRequest
 *
 * @package Motor\Revision\Http\Requests\Backend
 */
class AirportRequest extends Request
{
    /**
     * @OA\Schema(
     *   schema="AirportRequest",
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
     *   required={"name", "code"},
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
            'name'          => 'required',
            'code'          => 'required',
            'sort_position' => 'nullable|integer',
            'is_active'     => 'nullable|boolean',
        ];
    }
}
