<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            "surname" => 'required',
            "name" => 'required',
            "documento_tipo" => 'required',
            "documento_nro" => 'required',
            "cuit" => 'required',
            "email" => 'required',
            "confirmed" => "required|integer",
        ];
    }
}
