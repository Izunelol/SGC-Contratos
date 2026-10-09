<?php 
declare(strict_types=1);

namespace Src\App\Services\IServices;

use Src\App\Models\Contrato;

interface IContratoService
{
    public function create(array $data): Contrato;
    public function update(string $id, array $data): Contrato;
    public function delete(string $id): bool;
    public function getAll(): array;
    public function getById(string $id): ?Contrato;
    public function count(): int;
}




?>