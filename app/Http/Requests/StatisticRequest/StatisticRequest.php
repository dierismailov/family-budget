<?php

namespace App\Http\Requests\StatisticRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StatisticRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'budget_id' => $this->input('budget_id') ? 'required|integer': '',
            'type' => $this->input('type') ? 'required|string|in:expense,income' : '',
        ];
    }
}
