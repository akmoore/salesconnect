<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
                    'aes_id' => 'required',
                    'company_name' => 'required',
                    'primary_contact_first_name' => 'min:2',
                    'primary_contact_last_name' => 'min:2',
                    'street' => 'min:6',
                    'city' => 'min:3',
                    'state' => 'alpha|min:2',
                    'postal' => 'numeric|min:5',
                    'public_phone' => 'min:14',
                    'primary_contact_phone' => 'min:14',
                    'primary_contact_email' => 'email|unique:clients',
                    'url' => 'min:3'
                ];   
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'aes_id' => 'required',
                    'company_name' => 'required',
                    'primary_contact_first_name' => 'min:2',
                    'primary_contact_last_name' => 'min:2',
                    'street' => 'min:6',
                    'city' => 'min:3',
                    'state' => 'alpha|min:2',
                    'postal' => 'numeric|min:5',
                    'public_phone' => 'min:14',
                    'primary_contact_phone' => 'min:14',
                    'primary_contact_email' => 'email|unique:clients,id,' . $this->get('id'),
                    'url' => 'min:3'
                ];   
            }
            default: break;
        }
        
    }

    public function messages()
    {
        return [
            'aes_id.required' => 'You must pick at least one Account Executive.',
            'company_name.required' => 'Client\'s Name is required.',
            'primary_first_name.min' => 'First Name doesn\'t have enough characters.',
            'primary_last_name.min' => 'Last Name doesn\'t have enough characters.',
            'street.min' => 'Street doesn\'t have enough characters.',
            'city.min' => 'City doesn\'t have enough characters.',
            'state.min' => 'State doesn\'t have enough characters.',
            'state.alpha' => 'State can only accept letters.',
            'postal.min' => 'Zip Code doesn\'t have enough characters.',
            'postal.numeric' => 'Zip Code can only accept numbers.',
            'public_phone.min' => 'Public Phone number appears to not be complete. Remember to add area code.',
            'primary_contact_phone.min' => 'Primary Contact Phone number appears to not be complete. Remember to add area code.',
            'primary_contact_email.required' => 'POC Email is required.',
            'primary_contact_email.email' => 'POC Email must be properly formatted.',
            'primary_contact_email.unique' => 'POC Email must be unique.',
            'url.url' => 'Must enter a valid web address.'
        ];
    }
}
