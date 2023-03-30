<?php

namespace App\Http\Requests\Client;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => ['required','min:8', new MatchOldPassword],
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:new_password',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Không được để trống',
            'old_password.min' => 'Mật khẩu dài ít nhất 8 ký tự',
            'new_password.required' => 'Không được để trống',
            'new_password.min' => 'Mật khẩu dài ít nhất 8 ký tự',
            'confirm_password.required' => 'Không được để trống',
            'confirm_password.min' => 'Mật khẩu dài ít nhất 8 ký tự',
            'confirm_password.same' => 'Mật khẩu mới không trùng khớp',
        ];
    }
}
