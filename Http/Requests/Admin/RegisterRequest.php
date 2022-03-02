<?php

namespace Modules\AdminAuth\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Modules\AdminAuth\Rules\Phone;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nickname' => 'min:1|max:16',
            'password' => 'required|min:5|max:20',
            'username' => 'required|min:4|max:20',
            'phone' => ['required', new Phone()],
            'email' => 'email|unique:admin_users',
            'avatar' => 'string',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
