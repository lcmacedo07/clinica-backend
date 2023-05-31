<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'linkoriginal' => 'required|max:200',
            'linkshort' => 'required|max:40',
            'identfy' => 'max:20|unique:links,identfy,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'linkoriginal.required' => 'LINK ORIGINAL nao foi selecionado.',
            'linkoriginal.max' => 'LINK ORIGINAL deve ter no maximo :max caracteres.',
            'linkshort.required' => 'LINK SHORT nao foi selecionado.',
            'linkshort.max' => 'LINK SHORT deve ter no maximo :max caracteres.',
            'identfy.max' => 'IDENTIFICADOR deve ter no maximo :max caracteres.',
            'identfy.unique' => ' Ja existe IDENTIFICADOR com esse valor.',
        ];
    }
}

             