<?php

namespace App\Http\Requests\User;

use App\Traits\ErrorHandling;
use App\Traits\Sanitizer;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class UserRequest extends FormRequest
{
    use ErrorHandling, Sanitizer;

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
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'middlename' => 'required|string',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|max:15',
            'email' => 'required|email:rfc,dns|unique:users',
            'gender' => 'required|string',
            'user_type' => 'required|string'
        ];
    }


    /**
     *  This method is called before validation
     *  it will sanitize all input data before validate
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $input = $this->all();
        if (is_array($input)) {
            $sanitizedInput = $this->sanitizeArray($input);
            $this->merge($sanitizedInput);
        }
    }


    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = $this->formatErrors($validator->errors());
        $response = response()->json([
            'success' => false,
            'message' => 'Something went wrong!',
            'errors' => $errors,
        ], 422);

        throw new HttpResponseException($response);
    }
}
