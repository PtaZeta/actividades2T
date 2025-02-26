<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateEventoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => [
                'required',
                'date',
                'date_format:Y-m-d H:i:s',
                // Rule::date()->after(now()),
            ],
            'fecha_fin' => [
                'required',
                'date',
                'date_format:Y-m-d H:i:s',
                // Rule::date()->after('fecha_inicio'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'fecha_inicio.after' => 'La fecha de inicio debe ser despues a la de hoy',
            'fecha_fin.after' => 'La fecha de inicio debe ser anterior a la fecha de finalización.'
        ];
    }
}
