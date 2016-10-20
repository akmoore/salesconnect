<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarRequest extends FormRequest
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
                    'event_date' => 'required',
                    'event_start_time' => 'required',
                    'event_end_time' => 'required',
                    'event_type' => 'required',
                    'location' => 'required',
                    'duration_minutes' => 'numeric',
                    'duration_hours' => 'numeric'
                ];   
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'project_id' => 'required',
                    'event_date' => 'required',
                    'event_start_time' => 'required',
                    'event_end_time' => 'required',
                    'event_type' => 'required',
                    'location' => 'required',
                    'duration_minutes' => 'numeric',
                    'duration_hours' => 'numeric'
                ];   
            }
            default: break;
        }
        
    }

    public function messages()
    {
        return [
            'project_id.required' => 'The event must be associated with a project.',
            'event_date.required' => 'The event date is required.',
            'event_start_date.required' => 'The event start time is required.',
            'event_end_time.required' => 'The event end time is required.',
            'event_type.required' => 'The event type is required.',
            'location.required' => 'Location is required.'
        ];
    }
}

