<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array {
        return [
            'precio' => ['required','numeric','min:0'],
            'stock'  => ['required','integer','min:0'],
        ];
    }
}
