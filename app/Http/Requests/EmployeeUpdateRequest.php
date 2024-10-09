<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeUpdateRequest extends FormRequest
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

        $employeeId = $this->route('employee');

        return [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => [
                'nullable',
                'email',
                Rule::unique('employees', 'email')->ignore($employeeId)

            ],
            'phone' => [
                'nullable',
                'numeric',
                Rule::unique('employees', 'phone')->ignore($employeeId)
            ],
            'company_id' => 'required|numeric|exists:companies,id',
        ];
    }
}
