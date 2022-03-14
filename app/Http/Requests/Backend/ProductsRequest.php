<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'category' => 'required',
            'sku' => 'unique:products'
        ];
    }

    public function messages()
    {
        return [
            'sku.unique' => 'Mã sản phẩm đã tồn tại.',
            'name.required' => 'Tên sản phẩm không được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh cho sản phẩm.',
            'category.required' => 'Bạn chưa chọn danh mục sản phẩm.'
        ];
    }
}
