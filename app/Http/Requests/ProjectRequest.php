<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
                    'client_id' => 'required',
                    'title' => 'required',
                    'length' => 'required|numeric',
                    'air_date' => 'required',
                    'production_promotional' => 'required',
                    'production_free' => 'required',
                    'new_client' => 'required',
                ];   
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'client_id' => 'required',
                    'title' => 'required',
                    'length' => 'required|numeric',
                    'air_date' => 'required',
                    'production_promotional' => 'required',
                    'production_free' => 'required',
                    'new_client' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'min:8',
                    'c_number' => 'min:4',
                    'isci' => 'min:4',
                    'music_track' => 'min:6',
                    'youtube_link' => 'min:6',
                ];   
            }
            default: break;
        }
        
    }

    public function messages()
    {
        return [
            'client_id.required' => 'You must pick a Client.',
            'active.required' => 'You must determine whether this project is active.',
            'title.required' => 'This project must have a Title.',
            'length.required' => 'You must choose a length for this project.',
            'length.numeric' => 'The length property must be a number.',
            'air_date.required' => 'The Air Date is required.',
            // 'start_date.required' => 'The Start Date is required.',
            // 'production_promotional.required' => 'You must determine if this Production is promotional.',
            // 'production_free.required' => 'You must determine if this Production is free.'
            // 'new_client.required' => 'You must determine if this is the first project for the client.',
            // 'end_date.min' => 'End date must have at least 8 characters.',
            // 'c_number.min' => 'C Number must have at least 4 characters.',
            // 'isci.min' => 'ISCI must have at least 4 characters.',
            // 'music_track.min' = 'Music Track must have at least 6 characters.',
            // 'youtube_link.min' = 'YouTube Link must have at least 6 characters.'
        ];
    }
}

