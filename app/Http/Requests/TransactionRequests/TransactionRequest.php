<?php

namespace App\Http\Requests\TransactionRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'user_id' => 'required|min:0',
            'budget_id' => 'required|min:0',
            'amount' => 'required|integer|min:0',
            'category' => 'nullable',
            'type' => 'required|string|max:50'
        ];
    }
}
