<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostersRequest extends FormRequest
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
        $messageLength = 512;

        $validateDate = [
            'name'              => 'required|max:32|unique:posters',
            'get_message'       => 'required|max:' . $messageLength,
            'subscribe_message' => 'required|max:' . $messageLength,
            'success_message'   => 'required|max:' . $messageLength,
            'end_message'       => 'required|max:' . $messageLength,
            'end_time'          => 'required|max:32',
            'number'            => 'required|integer|max:99',
            'is_send'           => 'required|integer',
        ];

        return $validateDate;
    }
}
