<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserConsultRequest extends FormRequest
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
            'consult_address' => ['required', 'string', 'min:5'],
            'age' => ['required', 'integer'],
            'gender' => ['required', 'in:male,female'],
            'medical_history' => ['required', 'string', 'min:5'],
            'consulting_text' => ['required', 'string', 'min:5']
        ];
    }
}
