<?php

namespace App\Http\Requests\Comic;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateComicRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name' => ['required', Rule::unique('comics', 'name')->ignore($request->id)],
            'description'=>'required',
            'status'=>'required|in:0,1',
            'category_id'=>'required',
            'author'=>'required',
            'slug'=>['required',Rule::unique('comics','slug')->ignore($request->id)],
            'image'=>'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Không được để trống',
            'name.unique'=>'Tên truyện đã tồn tại, nhập tên khác',
            'description.required'=>'Không được để trống',
            'status.required'=>'Không được để trống',
            'status.in'=>'Giá trị phải là 0 hoặc 1',
            'category_id.required'=>'Không được để trống',
            'author.required'=>'Không được để trốngy',
            'slug.required'=>'Không được để trống',
            'slug.unique'=>'Slug đã tồn tại',
            'image.image'=>'Tệp phải là ảnh',
            'image.mimes'=>'Tệp không đúng định dạng',
            'image.max'=>'Kích thước tệp lớn hơn 2048KB',
        ];
    }
}
