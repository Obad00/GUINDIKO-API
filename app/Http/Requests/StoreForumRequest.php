<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreForumRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Changez cela en fonction de vos besoins d'autorisation
    }

    public function rules()
    {
        return [
            'nomForum' => 'required|string|max:255',
            'sujet' => 'required|string',
            // Ajoutez d'autres règles de validation si nécessaire
        ];
    }
}
