<?php

namespace App\Http\Requests\Auth;

use App\Traits\ErrorHandling;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class AuthRequest extends FormRequest
{
    use ErrorHandling;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return string[]
     */
    public function rules(): array
    {
        $rules = [
            'username' => 'required|string|max:20',
            'password' => 'required'
        ];

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Please enter your username!',
            'password.required' => 'Please enter your password!',
        ];
    }

    /**
     * Handle a failed validation attempt.
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        $formattedErrors = self::formatErrors($validator->errors());
        $response = response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $formattedErrors,
        ], 422);

        throw new HttpResponseException($response);
    }
}
