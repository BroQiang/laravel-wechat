<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostersSettingRequest extends FormRequest
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
            'avatar_size'              => 'required|integer|max:1024',
            'avatar_width'             => 'required|integer|max:1024',
            'avatar_height'            => 'required|integer|max:1024',
            'nickname_font_width'      => 'required|integer|max:1024',
            'nickname_font_height'     => 'required|integer|max:1024',
            'nickname_font_size'       => 'required|integer|max:1024',
            'nickname_font_top'        => 'required|integer|max:1024',
            'nickname_color'           => 'required|max:7',
            'nickname_backgroup_color' => 'required|max:7',
            'nickname_width'           => 'required|integer|max:1024',
            'nickname_height'          => 'required|integer|max:1024',
            'qrcode_size'              => 'required|integer|max:1024',
            'qrcode_width'             => 'required|integer|max:1024',
            'qrcode_height'            => 'required|integer|max:1024',
        ];
    }
}
