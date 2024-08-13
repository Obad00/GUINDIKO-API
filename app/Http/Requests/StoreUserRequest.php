<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'numeroTelephone' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', 'min:8', 'mixedCase', 'numbers', 'symbols'],
            'role' => 'required|string|in:menti,mentor', // Validation du rôle

            // Validation pour le mentor
            'domaineExpertise' => 'nullable|required_if:role,mentor|string|max:255',
            'experience' => 'nullable|required_if:role,mentor|string|max:255',
            'disponibilite' => 'nullable|required_if:role,mentor|string|max:255',

            // Validation pour le mente
            'motivation' => 'nullable|required_if:role,menti|string|max:255',
            'NiveauEtude' => 'nullable|required_if:role,menti|string|max:255',
        ];
    }
}
