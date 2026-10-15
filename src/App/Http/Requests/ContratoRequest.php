<?php 
declare(strict_types=1);

namespace Src\App\Http\Requests;

use Src\Core\Request;

class ContratoRequest extends Request
{
    public function rules(): array
    {
        return [
            'fornecedor'    => ['required', 'string'],
            'sei'    => ['required', 'string'],
            'startGov'    => ['nullable', 'string'],
            'contrato'    => ['nullable', 'string'],
            'objeto'    => ['required', 'string'],
            'vigencia_inico'    => ['required', 'date', 'dateFormat:Y-m-d'],
            'vigencia_fim'    => ['required', 'date','dateFormat:Y-m-d' ],
        ];
    }

    public function messages(): array
    {
        return [
            'fornecedor.required' => 'O campo fornecedor é obrigatório',
            'fornecedor.string' => 'O campo fornecedor deve ser um texto',
            'sei.required' => 'O campo SEI é obrigatório',
            'sei.string' => 'O campo SEI inválido',
            'startGov.string' => 'O campo StartGov inválido',
            'contrato.string' => 'O campo Contrato inválido',
            'objeto.required' => 'O campo Objeto é obrigatório',
            'objeto.string' => 'O campo Objeto inválido',
            'vigencia_inico.required' => 'O campo vigencia início é obrigatório',
            'vigencia_inico.date' => 'O campo vigencia início não é uma data válida',
            'vigencia_inico.dateFormat' => 'O campo vigencia início deve estar no formato dd/mm/AA',
            'vigencia_fim.required' => 'O campo vigencia fim é obrigatório',
            'vigencia_fim.date' => 'O campo vigencia fim não é uma data válida',
            'vigencia_fim.dateFormat' => 'O campo vigencia fim deve estar no formato dd/mm/AA'
        ];
    }
}





?>