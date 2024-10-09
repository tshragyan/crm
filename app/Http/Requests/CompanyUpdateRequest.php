<?php

namespace App\Http\Requests;

use App\Rules\ImageRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyUpdateRequest extends FormRequest
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
        $company = $this->route('company');
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('companies', 'name')->ignore($company->id)
            ],

            'email' => [
                'nullable',
                'email',
                Rule::unique('companies', 'email')->ignore($company->id)
            ],

            'website' => [
                'nullable',
                'url',
                Rule::unique('companies', 'website')->ignore($company->id)
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                new ImageRule(),
            ],
        ];
    }
}
