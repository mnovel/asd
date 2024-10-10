<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCandidateRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'program' => 'required|string',
            'photo' => 'required|file|mimes:jpg,jpeg,png,gif|max:3072',
            'order' => 'required|numeric|unique:candidates,order'
        ];
    }
}
