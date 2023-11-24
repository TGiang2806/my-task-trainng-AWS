<?php

namespace App\Http\Requests\User;
use Illuminate\Foundation\Http\FormRequest;
/////////////
class UserRequest extends FormRequest
{
    /**
     * Determine if the users is authorized to make this request.
     *
     * @return bool
     */
//    public function authorize()
//    {
//        return true;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed|min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'email.required' => 'Email cannot be empty'
        ];
    }
}
