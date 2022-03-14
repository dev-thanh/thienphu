<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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

    public function rules()
    {
        return [
            'image' => 'required',
            'name'  => 'max:100',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Bạn chưa chọn ảnh',
            'name.max'       => 'Trường tiêu đề phải nhỏ hơn 100 ký tự.'
        ];
    }
}
