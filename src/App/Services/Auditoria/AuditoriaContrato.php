<?php 

declare(strict_types=1);

namespace Src\App\Services\Auditoria;

use Src\App\Infrastructure\IRepositories\IContratoRepository;
use Src\App\Models\Contrato;
use Src\App\Services\IServices\IAuditoriaService;

class AuditoriaContrato implements IContratoRepository
{

    public function __construct(
        private IContratoRepository $repository,
        private IAuditoriaService $auditoriaService
    ) {
    }

    public function create(Contrato $contrato): Contrato
    {
        $criado = $this->repository->create($contrato);
        $this->auditoriaService->registrar(
            $_SESSION['user_id'] ?? null,
            'Contrato',
            'create',
            $criado->getId(),
            [
            'fornecedor' => $criado->getFornecedor(), 
            'sei' => $criado->getSei(), 
            'startGov' => $criado->getStartGov(),
            'contrato' => $criado->getContrato(),
            'objeto' => $criado->getObjeto(),
            'vigencia_inico' => $criado->getVigencia_inico(),
            'vigencia_fim' => $criado->getVigencia_fim(),
            ]
        );
        return $criado;
    }

    public function update(Contrato $contrato): Contrato
    {
        $antes = $this->repository->getById($contrato->getId());
        $atualizado = $this->repository->update($contrato);
        $this->auditoriaService->registrar(
            $_SESSION['user_id'] ?? null,
            'Contrato',
            'update',
            $atualizado->getId(),
            [
                'antes'  => [
                    'fornecedor' => $antes?->getFornecedor(), 
                    'sei' => $antes?->getSei(), 
                    'startGov' => $antes?->getStartGov(),
                    'contrato' => $antes?->getContrato(),
                    'objeto' => $antes?->getObjeto(),
                    'vigencia_inico' => $antes?->getVigencia_inico(),
                    'vigencia_fim' => $antes?->getVigencia_fim(),
                ],
                'depois' => [
                    'fornecedor' => $atualizado->getFornecedor(), 
                    'sei' => $atualizado->getSei(), 
                    'startGov' => $atualizado->getStartGov(),
                    'contrato' => $atualizado->getContrato(),
                    'objeto' => $atualizado->getObjeto(),
                    'vigencia_inico' => $atualizado->getVigencia_inico(),
                    'vigencia_fim' => $atualizado->getVigencia_fim(),
                ],
            ]
        );
        return $atualizado;
    }

    public function delete(string $id): bool
    {
        $deleted = $this->repository->delete($id);
        if ($deleted) {
            $this->auditoriaService->registrar(
                $_SESSION['user_id'] ?? null,
                'Contrato',
                'delete',
                $id,
                ['id' => 'Contrato com id ' . $id . ' deletado']
            );
        }
        return $deleted;
    }

    public function getAll(): array
    {
        return $this->repository->getAll();
    }

    public function getById(string $id): ?Contrato
    {
        return $this->repository->getById($id);
    }

    public function count(): int
    {
        return $this->repository->count();
    }


}






?>