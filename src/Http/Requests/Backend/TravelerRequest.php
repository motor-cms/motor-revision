<?php

namespace Motor\Revision\Http\Requests\Backend;

use Motor\Backend\Http\Requests\Request;

/**
 * Class TravelerRequest
 * @package Motor\Revision\Http\Requests\Backend
 */
class TravelerRequest extends Request
{

    /**
     * @OA\Schema(
     *   schema="TravelerRequest",
     *   @OA\Property(
     *     property="name",
     *     type="string",
     *     example="Example data"
     *   ),
     *   required={"name"},
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

        ];
    }
}
