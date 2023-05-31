<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountantRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'link_id' => 'required|integer',
            'quantity' => 'required|integer',

        ];
    }

    public function messages() 
    {
        return [
            'link_id.required' => 'LINK nao foi selecionado.',
            'link_id.numeric' => 'LINK deve ser numerico.',
            'quantity.required' => 'QUANTIDADE nao foi selecionado.',
            'quantity.numeric' => 'QUANTIDADE deve ser numerico.',
        ];
    }
}

             