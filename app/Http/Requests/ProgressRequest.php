<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgressRequest extends FormRequest
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
                    'prepro_schedule' => 'numeric',
                    'shoot_schedule' => 'numeric',
                    'initial_edit_done' => 'numeric',
                    'first_revision' => 'numeric',
                    'client_final_approval' => 'numeric',
                    'received_po' => 'numeric', 
                    'upload_master_control' => 'numeric',
                    'upload_youtube' => 'numeric',
                    'archived' => 'numeric',
                    'aired' => 'numeric',
                    'sum' => 'numeric'
                ];   
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'project_id' => 'required',
                    'prepro_schedule' => 'numeric',
                    'shoot_schedule' => 'numeric',
                    'initial_edit_done' => 'numeric',
                    'first_revision' => 'numeric',
                    'client_final_approval' => 'numeric',
                    'received_po' => 'numeric', 
                    'upload_master_control' => 'numeric',
                    'upload_youtube' => 'numeric',
                    'archived' => 'numeric',
                    'aired' => 'numeric',
                    'sum' => 'numeric'
                ];   
            }
            default: break;
        }
        
    }

    public function messages()
    {
        return [
            'project_id.required' => 'This note must be related to an existing project.'
        ];
    }
}

