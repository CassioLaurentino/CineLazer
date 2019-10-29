<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtracoesRequest extends FormRequest
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
            'nome' => 'required|min:2|max:100',
            'descricao' => 'required|min:2|max:250',
            'tipo_id' => 'required',
            'faixa_etaria' => 'required|numeric|max:21',
            'cartaz' => 'file|image|max:5000',
        ];
    }
}
