<?php

namespace App\Http\Requests;

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
                'date_format:d/m/Y H:i:s',
                Rule::date()->after(now()),
            ],
            'fecha_fin' => [
                'required',
                'date_format:d/m/Y H:i:s',
                'date',
                Rule::date()->after('fecha_inicio'),
            ],
        ];
    }
}
