<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToWlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return 2 +3;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //TODO add phone numbers and country codes librarys
        return [
            'phone'     => 'required|unique:investors|max:15',
            'country'   => 'required|max:10',
            'email'     => 'required|max:40',
            'telegram'  => 'required|max:20'
        ];
    }

    public function messages()
    {
        return [
            'phone.required'    => 'Phone is required',
            'country.required'  => 'Country is required',
            'email:required'    => 'Email is required',
            'telegram:required' => 'Telegram is required'
        ];
    }
}
