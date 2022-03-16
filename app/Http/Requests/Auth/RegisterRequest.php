<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:5', 'max:30'],
            'email' => ['required', 'string', 'min:5', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'phone' => ['required', 'string', 'unique:users'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ];
    }
}
