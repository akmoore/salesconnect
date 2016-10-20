<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Manager;

class ManagerRequest extends FormRequest
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
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'work_phone' => 'min:14',
                    'cell_phone' => 'min:14',
                    'email' => 'required|email|unique:managers',
                    'team' => 'required'
                ];   
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'work_phone' => 'min:14',
                    'cell_phone' => 'min:14',
                    'email' => 'required|email|unique:managers,id,' . $this->get('id'),
                    'team' => 'required'
                ];   
            }
            default: break;
        }
        
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'work_phone.min' => 'Work Phone number appears to not be complete. Remember to add area code.',
            'cell_phone.min' => 'Cell Phone number appears to not be complete. Remember to add area code.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be properly formatted.',
            'email.unique' => 'Email must be unique.',
            'team.required' => 'Team is required.'
        ];
    }
}
