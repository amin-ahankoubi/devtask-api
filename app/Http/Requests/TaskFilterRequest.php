<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'sometimes|in:todo,in-progress,done',
            'priority' => 'sometimes|in:low,medium,high',

            'sort' => 'sometimes|in:created_at,title,priority,status',
            'direction' => 'sometimes|in:asc,desc',
        ];
    }
}
