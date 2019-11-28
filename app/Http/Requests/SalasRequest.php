<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalasRequest extends FormRequest
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
            'nome' => 'required|min:2|max:150',
            'colunas' => 'required|min:1|max:20',
            'fileiras' => 'required|min:1|max:15',
        ];
    }
}
