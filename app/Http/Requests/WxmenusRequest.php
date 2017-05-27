<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WxmenusRequest extends FormRequest
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
        if (empty($this->route('id'))) {
            return [
                'name'   => 'required|max:4',
                'type'   => 'required',
                'action' => 'required|max:255',
            ];
        }

        return [
            'name'   => 'required|max:7',
            'type'   => 'required',
            'action' => 'required|max:255',
        ];

    }
}
