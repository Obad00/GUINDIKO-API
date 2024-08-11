<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRendezVousRequest extends FormRequest
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
            // 'sujet' => 'sometimes|string|max:255',
            // 'date_rendezVous' => 'sometimes|date',
            // 'statut' => 'sometimes|in:Reporté,Confirmé',
            // 'mente_id' => 'sometimes|exists:mentes,id',
            // 'mentor_id' => 'sometimes|exists:mentors,id',
        ];
    }
}
