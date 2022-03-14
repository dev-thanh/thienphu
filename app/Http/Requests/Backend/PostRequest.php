<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'required',
            'category' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tiêu đề bài viết không được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh đại diện.',
            'category.required' => 'Bạn chưa chọn danh mục bài viết.',
            
        ];
    }
}
