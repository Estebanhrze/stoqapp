<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array {
        return [
            'codigo' => ['required','string','max:50','unique:products,codigo'],
            'nombre' => ['required','string','max:150'],
            'costo'  => ['required','numeric','min:0'],
            'precio' => ['required','numeric','min:0'],
            'stock'  => ['required','integer','min:0'],
        ];
    }
}
