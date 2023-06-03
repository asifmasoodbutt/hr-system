<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * Custom validation error.
     */
    protected function failedValidation(Validator $validator)
    {
        $request_data = $this->request->all();
        storeApiResponseData($request_data['api_request_id'], $validator->errors()->first(), 422, false);
        throw new HttpResponseException(
            response()->error($validator->errors()->first(), 422)
        );
    }
}
