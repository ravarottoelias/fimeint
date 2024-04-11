<?php

namespace App\Http\Requests;

use App\Curso;
use App\Categoria;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CursoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'categoria_id' => [
                'required',
                'integer',
                Rule::in(Categoria::all()->pluck('id')->toArray()),
            ],
            'estado' => [
                'required',
                Rule::in(Curso::ESTADO_PROXIMO, Curso::ESTADO_EN_CURSO, Curso::ESTADO_FINALIZADO)
            ],
            'publicado' => [
                'required',
                Rule::in(Curso::PUBLICADO, Curso::NO_PUBLICADO)
            ]

        ];
    }
}
