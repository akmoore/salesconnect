<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'agency_name' => 'required',
                    'contact_first_name' => 'min:3',
                    'contact_last_name' => 'min:3',
                    'contact_phone' => 'min:14',
                    'contact_email' => 'email|unique:agencies'
                ];   
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'agency_name' => 'required',
                    'contact_first_name' => 'min:3',
                    'contact_last_name' => 'min:3',
                    'contact_phone' => 'min:14',
                    'contact_email' => 'email|unique:agencies,id,' . $this->get('id'),
                ];   
            }
            default: break;
        }
        
    }

    public function messages()
    {
        return [
            'agency_name.required' => 'An Agency Name is required.',
            'contact_first_name.min' => 'Need at least 3 characters for Contact\'s First Name.',
            'contact_last_name.min' => 'Need at least 3 characters for Contact\'s Last Name.',
            'contact_phone.min' => 'Contact\'s Phone number appears to not be complete. Remember to add area code.',
            'contact_email.email' => 'Contact\'s Email must be properly formatted.',
            'contact_email.unique' => 'Contact\'s Email must be unique.'
        ];
    }
}

