<?php

namespace Motor\Revision\Http\Requests\Backend;

use Motor\Backend\Http\Requests\Request;

/**
 * Class SponsorRequest
 *
 * @package Motor\Revision\Http\Requests\Backend
 */
class SponsorRequest extends Request
{
    /**
     * @OA\Schema(
     *   schema="SponsorRequest",
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
     *   required={"name", "level"},
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
            'url'           => 'nullable',
            'level'         => 'required|in:'.implode(',', array_flip(trans('motor-revision::backend/sponsors.levels'))),
            'sort_position' => 'nullable|integer',
            'is_active'     => 'nullable|boolean',
            'text'          => 'nullable',
        ];
    }
}
