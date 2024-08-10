<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationRequest extends FormRequest
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
            'demande_mentorat_id' => 'nullable|exists:demande_mentorats,id',
            'rendez_vous_id' => 'nullable|exists:rendez_vouses,id',
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
            'demande_mentorat_id.exists' => 'Le demande_mentorat_id spécifié n\'existe pas.',
            'rendez_vous_id.exists' => 'Le rendez_vous_id spécifié n\'existe pas.',
        ];
    }
}
