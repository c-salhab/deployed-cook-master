<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'steps' => ['required', 'min:3', 'max:255'],
            'image' => ['required','image'],
            'duration' => ['required'],
            'difficulty' => ['required'],
            'quantity' => ['required'],
            'ingredients' => ['required']

        ];
    }
}
