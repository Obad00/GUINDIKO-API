<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDemandeMentoratRequest extends FormRequest
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

                'statut' => ['required', 'string', 'in:En attente,Acceptée,Refusée'],
                'mente_id' => ['required', 'exists:mentes,id'],  // Vérifie que l'ID du mente existe dans la table `mentes`
                'mentor_id' => ['required', 'exists:mentors,id'], // Vérifie que l'ID du mentor existe dans la table `mentors`
            ];
    
    }
}
