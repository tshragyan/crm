<?php

namespace App\Http\Requests;

use App\Rules\ImageRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateRequest extends FormRequest
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
            'name' => 'required|string|unique:companies,name',
            'email' => 'nullable|email|unique:companies,email',
            'website' => 'nullable|url|unique:companies,website',
            'logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                new ImageRule(),
            ],
        ];
    }
}
