<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTimesheetRequest extends FormRequest
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
            'difficult' => 'nullable|max:255',
            'planning' => 'required|max:255',
            'tasks.*.task_id' => 'nullable|max:10',
            'tasks.*.spent_time' => 'nullable|integer|max:23|required_with:tasks.*.content',
            'tasks.*.content' => 'nullable|required_with:tasks.*.task_id,tasks.*.spent_time|max:255'
        ];    
    }
}
