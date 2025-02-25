<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreVideojuegoRequest extends FormRequest
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
            'titulo' => 'required|string|max:255',
            'anyo' => 'required|numeric|min:1900|max:2025',
            'desarrolladora_id' => 'required|exists:desarrolladoras,id'
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'El titulo es obligatio',
        ];
    }
}
