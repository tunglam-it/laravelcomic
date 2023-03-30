<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required',
            'url' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'title.required'=>'Không được để trống',
            'content.required'=>'Không được để trống',
            'slug.required'=>'Không được để trống',
            'url.required'=>'Không được để trống',
        ];
    }
}
