<?php 
declare(strict_types=1);

namespace Src\App\Http\Controllers;

use Src\App\Http\Exceptions\Contrato\ContratoException;
use Src\App\Http\Exceptions\ExtratorContrato\ExtracaoContratoException;
use Src\App\Http\Requests\ContratoRequest;
use Src\App\Http\Requests\ExtratorContratoRequest;
use Src\App\Services\IServices\IContratoService;
use Src\App\Services\IServices\IExtratorContratoService;
use Src\App\Utils\Toast;
use Src\App\Utils\Url;
use Src\App\Utils\View;
use Src\Core\Logger;

class ContratoController extends SharedController
{
    public function __construct(
        private IContratoService $contratoService,
        private IExtratorContratoService $extratorService
    ) {
    }

    public function index(): string
    {
        try {
            $itens = $this->contratoService->getAll();
            $content = View::render('Contrato/index', [
                'itens'      => $itens,
                'voltarUrl'  => Url::path('/home'),
                'urlCriar'   => Url::path('/contrato/criar'),
                'deletarUrl' => Url::path('/contrato/deletar'),
                'editarUrl'  => Url::path('/contrato/editar'),
            ]);

            return self::getPage('Contrato - LISTAGEM', $content, [
                'showSidebar' => true,
                'bodyClass'   => 'contrato-page',
                'activePage'  => 'contrato',
            ]);
        } catch (ContratoException $e) {
            Toast::error($e->getMessage());
            Logger::error($e->getMessage());
            Url::redirect('/home');
        }
    }

    public function extrair(): never
    {
        $request = (new ExtratorContratoRequest($_POST))->redirectOnFail();

        try {
            $dados = $this->extratorService->extrairDeUpload($_FILES['arquivo']);

            $_SESSION['old_input'] = $dados;
            Toast::success('Confira os dados extraídos antes de salvar.');
        } catch (ExtracaoContratoException $e) {
            Toast::error($e->getMessage());
            Logger::error($e->getMessage());
        }

        Url::redirect('/contrato/criar');
    }

    public function criar(): string
    {
        $content = View::render('Contrato/criar', [
            'voltarUrl' => Url::path('/contrato'),
            'urlSalvar' => Url::path('/contrato/salvar'),
            'urlExtrair' => Url::path('/contrato/extrair'),
        ]);

        return self::getPage('Contrato - NOVO REGISTRO', $content, [
            'showSidebar' => true,
            'bodyClass'   => 'contrato-page',
            'activePage'  => 'contrato',
        ]);
    }

    public function editar(): string
    {
        $id = trim((string) filter_input(INPUT_GET, 'id'));

        if ($id === '') {
            Toast::error('ID inválido.');
            Url::redirect('/contrato');
        }

        try {
            $item = $this->contratoService->getById($id);

            if ($item === null) {
                Toast::error('Registro não encontrado.');
                Url::redirect('/contrato');
            }

            $content = View::render('Contrato/editar', [
                'voltarUrl' => Url::path('/contrato'),
                'urlSalvar' => Url::path('/contrato/atualizar'),
                'item'      => $item,
            ]);

            return self::getPage('Contrato - EDITAR REGISTRO', $content, [
                'showSidebar' => true,
                'bodyClass'   => 'contrato-page',
                'activePage'  => 'contrato',
            ]);
        } catch (ContratoException $e) {
            Toast::error($e->getMessage());
            Logger::error($e->getMessage());
            Url::redirect('/contrato');
        }
    }

    public function salvar(): never
    {
        try {
            $request = (new ContratoRequest($_POST))->redirectOnFail();
            $validated = $request->validated();

            $this->contratoService->create($validated);
            Toast::success('Registro criado com sucesso!');
            Url::redirect('/contrato');
        } catch (ContratoException $e) {
            Toast::error($e->getMessage());
            Logger::error($e->getMessage());
            Url::redirect('/contrato');
        }
    }

    public function atualizar(): void
    {
        try {
            $request = (new ContratoRequest($_POST))->redirectOnFail();
            $validated = $request->validated();

            $this->contratoService->update((string) $validated['id'], $validated);
            Toast::success('Registro atualizado com sucesso!');
            Url::redirect('/contrato');
        } catch (ContratoException $e) {
            Toast::error($e->getMessage());
            Logger::error($e->getMessage());
            Url::redirect('/contrato/editar?id=' . ($_POST['id'] ?? ''));
        }
    }

    public function deletar(): void
    {
        $id = trim((string) filter_input(INPUT_POST, 'id'));

        if ($id === '') {
            Toast::error('ID inválido.');
            Url::redirect('/contrato');
        }

        try {
            $this->contratoService->delete($id);
            Toast::success('Registro deletado com sucesso!');
            Url::redirect('/contrato');
        } catch (ContratoException $e) {
            Toast::error($e->getMessage());
            Logger::error($e->getMessage());
            Url::redirect('/contrato');
        }
    }




}





?>