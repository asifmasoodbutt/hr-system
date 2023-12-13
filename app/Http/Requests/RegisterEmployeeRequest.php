<?php

namespace App\Http\Requests;

use App\Rules\ExperiencesRequiredIfRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterEmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'gender_id' => 'required|integer|exists:genders,id',
            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8',
            'father_name' => 'required|string|max:50',
            'cnic_number' => 'required|digits:13|unique:users,cnic',
            'mobile_number' => 'required|digits_between:11,15',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'department_id' => 'required|integer|exists:departments,id',
            'bank_name' => 'required|string|max:50',
            'bank_account_number' => 'required|string|min:6|max:50',
            'degree_level_id' => 'required|integer|exists:degree_levels,id',
            'institute' => 'required|string|max:50',
            'graduation_year' => 'required|integer|date_format:Y|after:date_of_birth',
            'pay_scale_id' => 'required|integer|exists:pay_scales,id',
            'position' => 'required|string|max:50',
            'job_description' => 'required|string|max:255',
            'contract_type_id' => 'required|integer|exists:contract_types,id',
            'start_date' => 'required|date|date_format:Y-m-d|after:date_of_birth',
            'end_date' => 'nullable|date_format:Y-m-d|after:start_date',
            // If the user is of Entry level, experiences are not required
            'experiences' => [
                'array',
                new ExperiencesRequiredIfRule($this->input('pay_scale_id')),
            ],
            'experiences.*.company_name' => 'required|string|max:50',
            'experiences.*.latest_position' => 'required|string|max:50',
            'experiences.*.company_start_date' => 'required|date|date_format:Y-m-d|after:date_of_birth',
            'experiences.*.company_end_date' => 'required|date|date_format:Y-m-d|after:company_start_date',
            'no_of_children' => 'nullable|integer|lt:15',
            'spouse_name' => 'string|max:50'
        ];
    }

    public function messages()
    {
        return [
            'experiences.array' => 'The experiences field must be an array.',
            'experiences.*.company_name.required' => 'The company name is required for each experience.',
            'experiences.*.company_name.string' => 'The company name must be a string.',
            'experiences.*.company_name.max' => 'The company name must not exceed :max characters.',
            'experiences.*.latest_position.required' => 'The latest position is required for each experience.',
            'experiences.*.latest_position.string' => 'The latest position must be a string.',
            'experiences.*.latest_position.max' => 'The latest position must not exceed :max characters.',
            'experiences.*.company_start_date.required' => 'The company joining date is required for each experience.',
            'experiences.*.company_start_date.date' => 'The company joining date must be a valid date.',
            'experiences.*.company_start_date.date_format' => 'The company joining date must be in the format Y-m-d.',
            'experiences.*.company_end_date.required' => 'The company quit date is required for each experience.',
            'experiences.*.company_end_date.date' => 'The company quit date must be a valid date.',
            'experiences.*.company_end_date.date_format' => 'The company quit date must be in the format Y-m-d.'
        ];
    }

    /**
     * Custom validation error.
     */
    protected function failedValidation(Validator $validator)
    {
        storeApiResponseData($this->input('api_request_id'), $validator->errors()->first(), 422, false);
        throw new HttpResponseException(
            response()->error($validator->errors()->first(), 422)
        );
    }
}
