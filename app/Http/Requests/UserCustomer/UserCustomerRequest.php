<?php

namespace App\Http\Requests\UserCustomer;
use Illuminate\Foundation\Http\FormRequest;

class UserCustomerRequest extends FormRequest
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
            'email' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter a name',
            'email.required' => 'Email cannot be empty'
        ];
    }
}
