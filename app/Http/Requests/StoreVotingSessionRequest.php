<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVotingSessionRequest extends FormRequest
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
            'name' => 'required|string|max:15|unique:voting_sessions,name',
            'time' => 'required|regex:/^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2} [APM]{2} - \d{2}\/\d{2}\/\d{4} \d{2}:\d{2} [APM]{2}$/',
        ];
    }
}
