<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            // 'title.required' => 'abc is required.',
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:tasks,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
            'deadline' => 'required|date',
            'type' => 'required|in:Work,Personal,Urgent',
        ];
    }
}
