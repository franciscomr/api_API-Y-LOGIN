<?php

namespace App\Http\Requests\Api\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
        $rules = [
            'branch_id' => ['required', 'exists:branches,id'],
            'position_id' => ['required', 'exists:positions,id'],
            'first_surname' => ['required', 'min:3', 'max:32'],
            'second_surname' => ['required', 'min:3', 'max:32'],
            'hire_date' => ['required', 'date'],
        ];
        if ($this->isMethod('post')) {
            $rules += [
                'name' => [
                    'required', 'min:3', 'max:32',
                    Rule::unique('employees')
                        ->where('name', $this->name)
                        ->where('first_surname', $this->first_surname)
                        ->where('second_surname', $this->second_surname)
                ],
                'identifier' => ['unique:employees,identifier', ' nullable'],
            ];
        } else {
            $rules += [
                'name' => [
                    'required',
                    Rule::unique('employees')
                        ->ignore($this->id)
                        ->where('name', $this->name)
                        ->where('firstSurname', $this->firstSurname)
                        ->where('secondSurname', $this->secondSurname)
                ],
                'identifier' => 'nullable| unique:employees,identifier,' . $this->id,
            ];
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $this->replace($this->all()['data']['attributes']);
    }
}
