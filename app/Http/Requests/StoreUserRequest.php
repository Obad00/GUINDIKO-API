<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'numeroTelephone' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', 'min:8'],
            'role' => 'required|in:mentor,menti,admin',
            'domaineExpertise' => 'required_if:role,mentor|string|max:255',
            'experience' => 'required_if:role,mentor|string|max:255',
            'disponibilite' => 'required_if:role,mentor|string|max:255',
            'motivation' => 'required_if:role,menti|string|max:255',
            'NiveauEtude' => 'required_if:role,menti|string|max:255',
        ];
    }
}
