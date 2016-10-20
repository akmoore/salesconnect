<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
                    'project_id' => 'required',
                    'title' => 'required',
                    'primary' => 'required',
                    'comments' => 'required|min:30',
                    'emailable' => 'required',
                    'has_been_emailed' => 'numeric'
                ];   
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'project_id' => 'required',
                    'title' => 'required',
                    'primary' => 'required',
                    'comments' => 'required|min:30',
                    'emailable' => 'required',
                    'has_been_emailed' => 'numeric'
                ];   
            }
            default: break;
        }
        
    }

    public function messages()
    {
        return [
            'project_id.required' => 'This note must be related to an existing project.',
            'title.required' => 'Title is required.',
            'primary.required' => 'You must determine whether or not if this is a primary note.',
            'comments.min' => 'Need at least 30 characters for the notes field.',
            'comments.required' => 'Notes are required.',
            'emailable.required' => 'You must choose if you want to email this note.'
        ];
    }
}
