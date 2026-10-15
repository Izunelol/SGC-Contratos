<?php

declare(strict_types=1);

namespace Src\App\Http\Requests;

use Src\Core\Request;

class ExtratorContratoRequest extends Request
{
    public function rules(): array
    {
        return [
            'arquivo'        => ['required', 'fileSize:5120', 'fileType:pdf'],

        ];
    }

    public function messages(): array
    {
        return [
            'arquivo.required' => 'O envio do arquivo é obrigatório',
            'arquivo.fileSize' => 'Selecione um arquivo PDF de até 5 MB.',
            'arquivo.fileType' => 'O arquivo não é um tipo válido',
        ];
    }
}
