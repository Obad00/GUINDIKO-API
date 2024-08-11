<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMentorRequest extends FormRequest
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
            // 'nom' => 'required|string|max:255',
            // 'prenom' => 'required|string|max:255',
            // 'numeroTelephone' => 'required|integer',
            // 'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:8|confirmed',
            // 'domaineExpertise' => 'required|string|max:255',
            // 'experience' => 'required|string|max:255',
            // 'disponibilite' => 'required|boolean',
        ];
    }
}
