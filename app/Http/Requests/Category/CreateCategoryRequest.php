<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:categories',
            'description'=>'required',
            'slug'=>'required|unique:comics',
            'status'=>'required|in:0,1',
        ];
    }

    public function messages()
    {
        return[
            'name.required'=>'Không được để trống',
            'name.unique'=>'Tên không được trùng!!!',
            'description.required'=>'Không được để trống',
            'slug.required'=>'Không được để trống',
            'slug.unique'=>'Slug đã tồn tại',
            'status.required'=>'Không được để trống',
            'status.in'=>'Chỉ nhận giá trị 0 hoặc 1',
        ];
    }
}
