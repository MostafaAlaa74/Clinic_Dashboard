<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppoitmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:250',
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'You Should Choose A Date',
            'date.after_or_equal' => 'The date must be today or a future date',
            'time.required' => 'You Should Choose A Time',
            'time.date_format' => 'The time must be in the format HH:MM',
            // 'time.between' => 'The time must be between 09:00 and 17:00',
            'notes.max' => 'This Field Must Be Less Than 250 Character'
        ];
    }
}
