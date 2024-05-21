<?php

namespace App\Http\Requests\Api\Company;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
            'company_id' => ['required', 'exists:companies,id'],
            'address' => ['required', 'min:3', 'max:64'],
            'city' => ['required', 'min:3', 'max:32'],
            'state' => ['required', 'min:3', 'max:32'],
            'city' => ['required', 'min:3', 'max:32'],
            'postal_code' => ['required', 'digits:5']
        ];
        if ($this->isMethod('post')) {
            $rules += ['name' => ['required', 'min:3', 'max:32', 'unique:branches']];
        } else {
            $rules += ['name' => ['required', 'min:3', 'max:32', 'unique:branches,id,' . $this->id]];
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $this->replace($this->all()['data']['attributes']);
    }
}
