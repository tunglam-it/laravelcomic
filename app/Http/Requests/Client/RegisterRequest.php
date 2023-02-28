<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|unique:users',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được để trống',
            'name.unique' => 'Tên hiển thị đã trùng lặp',
            'email.required' => 'Không được để trống',
            'email.unique' => 'Email đã trùng lặp',
            'email.email' => 'Không đúng định dạng email',
            'password.required' => 'Không được để trống',
            'password.min' => 'Mật khẩu dài ít nhất 8 ký tự',
        ];
    }
}
