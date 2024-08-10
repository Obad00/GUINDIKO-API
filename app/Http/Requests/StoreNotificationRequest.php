<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette demande.
     */
    public function authorize(): bool
    {
        // Autoriser toutes les requêtes pour cette démonstration
        return true;
    }

    /**
     * Obtenez les règles de validation qui s'appliquent à la demande.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'demande_mentorat_id' => 'required|exists:demande_mentorats,id',
            'rendez_vous_id' => 'required|exists:rendez_vouses,id',
        ];
    }

    /**
     * Obtenez les messages de validation personnalisés.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'demande_mentorat_id.required' => 'Le champ demande_mentorat_id est requis.',
            'demande_mentorat_id.exists' => 'Le demande_mentorat_id spécifié n\'existe pas.',
            'rendez_vous_id.required' => 'Le champ rendez_vous_id est requis.',
            'rendez_vous_id.exists' => 'Le rendez_vous_id spécifié n\'existe pas.',
        ];
    }
}
