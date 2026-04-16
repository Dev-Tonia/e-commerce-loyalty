<?php

namespace App\Http\Requests;

// use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\Attributes\StopOnFirstFailure;
use Illuminate\Foundation\Http\FormRequest;

#[StopOnFirstFailure]
class StorePurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'item_name' => ['required', 'string', 'max:255'],
            'amount'    => ['required', 'numeric', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'item_name.required' => 'Item name is required',
            'item_name.string'   => 'Item name must be a string',
            'item_name.max'      => 'Item name cannot exceed 255 characters',
            'amount.required'    => 'Purchase amount is required',
            'amount.numeric'     => 'Purchase amount must be a number',
            'amount.min'         => 'Purchase amount must be at least 1',
        ];
    }
}
