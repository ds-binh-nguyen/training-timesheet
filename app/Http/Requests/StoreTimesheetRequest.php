<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimesheetRequest extends FormRequest
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
        return [
            'time_check_in' => 'required|date|unique:timesheets,time_check_in,NULL,id,user_id,'. auth()->id(),
            'difficult' => 'nullable|max:255',
            'planning' => 'required|max:255',
            'tasks.*.task_id' => 'nullable|max:10',
            'tasks.*.spent_time' => 'nullable|integer|max:23',
            'tasks.*.content' => 'nullable|required_with:tasks.*.task_id,tasks.*.spent_time|max:255'
        ];
    }
}
