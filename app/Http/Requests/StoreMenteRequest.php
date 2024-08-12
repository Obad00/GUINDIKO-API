<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreMenteRequest extends FormRequest
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
        //     'nom' => ['required', 'string', 'max:30'],
        //     'prenom' => ['required', 'string', 'max:65'],
        //     'email' => ['required', 'email', 'unique:mentes,email'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     'numeroTelephone' => ['required', 'numeric', 'digits_between:1,15'] ,
        ];
    }

    public function failedValidation (Validator $validator)
    {
        // throw new HttpResponseException(response()->json(
        //     ['success' => false, 'errors' => $validator->errors()],
        //     422
        // ));
    }
}
