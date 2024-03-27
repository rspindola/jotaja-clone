<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreCompanyRequest extends FormRequest
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
          'user_id' => 'required|exists:users,id',
          'department_id' => 'required',
          'name' => 'required|string|max:255',
          'description' => 'nullable|string',
          'email' => 'required|email',
          'cnpj' => 'required|string|max:20',
          'phone' => 'required|string|max:20',
          'phone_alternative' => 'nullable|string|max:20',
          'whatsapp' => 'nullable|string|max:20',
          'address_line_1' => 'required|string|max:255',
          'address_line_2' => 'nullable|string|max:255',
          'city' => 'required|string|max:255',
          'state' => 'required|string|max:255',
          'postal_code' => 'required|string|max:20',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
