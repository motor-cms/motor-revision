<?php

namespace Motor\Revision\Http\Requests\Backend;

use Motor\Backend\Http\Requests\Request;

/**
 * Class ShuttleRequest
 * @package Motor\Revision\Http\Requests\Backend
 */
class ShuttleRequest extends Request
{

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
