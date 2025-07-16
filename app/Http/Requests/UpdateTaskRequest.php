<?php
// app/Http/Requests/UpdateTaskRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'titulo'       => 'sometimes|required|string|max:255',
            'descripcion'  => 'sometimes|nullable|string',
            'completada'   => 'sometimes|boolean',
            'fecha_limite' => 'sometimes|nullable|date',
        ];
    }
}
