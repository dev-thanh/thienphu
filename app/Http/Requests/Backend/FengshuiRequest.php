<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class FengshuiRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'required',
            'category' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tiêu đề số phòng không được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh cho số phòng.',
            'category.required' => 'Bạn chưa chọn danh mục số phòng.'
        ];
    }
}
