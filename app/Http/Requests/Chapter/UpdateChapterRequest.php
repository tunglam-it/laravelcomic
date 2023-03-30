<?php

namespace App\Http\Requests\Chapter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateChapterRequest extends FormRequest
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
            'title'=>['required',Rule::unique('chapters', 'title')->ignore($request->id)],
            'comic_id'=>'required',
            'description'=>'required',
            'chapter_content'=>'required',
            'status'=>'required|in:0,1',
            'slug_chapter'=>['required',Rule::unique('chapters', 'slug_chapter')->ignore($request->id)],
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Không được để trống',
            'title.unique'=>'Tiêu đề đã tồn tại',
            'description.required'=>'Không được để trống',
            'comic_id.required'=>'Không được để trống',
            'chapter_content.required'=>'Không được để trống',
            'status.required'=>'Không được để trống',
            'status.in'=>'Giá trị phải là 0 hoặc 1',
            'slug_chapter.required'=>'Không được để trống',
            'slug_chapter.unique'=>'Slug đã tồn tại',
        ];
    }
}
