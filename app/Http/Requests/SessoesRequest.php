<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessoesRequest extends FormRequest
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
            'local' => 'required|min:2|max:150',
            'atracao_id' => 'required',
            'data' => 'required|after:today',
            'hora' => 'required|date_format:H:i',
            'numero_de_poltronas' => 'required|numeric|max:601',
        ];
    }
}
