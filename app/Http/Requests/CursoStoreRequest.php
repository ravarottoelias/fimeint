<?php

namespace App\Http\Requests;

use App\Categoria;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CursoStoreRequest extends FormRequest
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

        ];
    }
}
