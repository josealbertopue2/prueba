<?php
// app/Http/Requests/StoreTaskRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'titulo'       => 'required|string|max:255',
            'descripcion'  => 'nullable|string',
            'completada'   => 'sometimes|boolean',
            'fecha_limite' => 'nullable|date',
        ];
    }
}
