<?php

namespace Botble\Offers\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class OffersRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => 'required',
            'image'   => 'required',
            'content'   => 'required',
            'description'   => 'required',
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
