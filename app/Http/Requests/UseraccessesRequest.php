<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UseraccessesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'link_id' => 'required|integer',
            'ip' => 'required|max:40',
            'useragent' => 'required|max:40',

        ];
    }

    public function messages() 
    {
        return [
            'link_id.required' => 'LINK nao foi selecionado.',
            'link_id.numeric' => 'LINK deve ser numerico.',
            'ip.required' => 'IP nao foi selecionado.',
            'ip.max' => 'IP deve ter no maximo :max caracteres.',
            'useragent.required' => 'USER AGENT nao foi selecionado.',
            'useragent.max' => 'USER AGENT deve ter no maximo :max caracteres.',
        ];
    }
}

             