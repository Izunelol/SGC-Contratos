<?php 

declare(strict_types=1);

namespace Src\App\Services;

use Src\App\Http\Exceptions\Contrato\ContratoException;
use Src\App\Infrastructure\IRepositories\IContratoRepository;
use Src\App\Models\Contrato;
use Src\App\Services\IServices\IContratoService;

class ContratoService implements IContratoService
{
    public function __construct(
        private IContratoRepository $repository
    ) {
    }

    public function create(array $data): Contrato
    {
        $agora = date('Y-m-d H:i:s');

        $novo = Contrato::fromArray([
            'fornecedor' => $data['fornecedor'],
            'sei' => $data['sei'],
            'startGov' => $data['startGov'] ?? null,
            'contrato' => $data['contrato'] ?? null,
            'objeto' => $data['objeto'],
            'vigencia_inico' => $data['vigencia_inico'],
            'vigencia_fim' => $data['vigencia_fim'],
            'created_at' =>$agora,
            'status' => $data['status'],
            'updated_at' => $agora,
            
            
        ]);

        return $this->repository->create($novo);
    }

    public function update(string $id, array $data): Contrato
    {
        $existente = $this->repository->getById($id);

        if ($existente === null) {
            throw ContratoException::naoEncontrado();
        }

        $atualizado = Contrato::fromArray([
            'id' => $id,
            'status' => $existente->getStatus(),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->repository->update($atualizado);
    }

    public function delete(string $id): bool
    {
        $existente = $this->repository->getById($id);

        if ($existente === null) {
            throw ContratoException::naoEncontrado();
        }

        return $this->repository->delete($id);
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