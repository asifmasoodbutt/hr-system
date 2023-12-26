<?php

namespace App\Http\Requests\Leave;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CancelLeaveRequest extends FormRequest
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
            'leave_request_id' => 'required|integer|exists:leave_requests,id'
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
