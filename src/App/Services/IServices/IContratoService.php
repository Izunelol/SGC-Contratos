<?php 
declare(strict_types=1);

namespace Src\App\Services\IServices;

use Src\App\Models\Contrato;

interface IContratoService
{
    public function create(Contrato $exemplo): Contrato;
    public function update(Contrato $exemplo): Contrato;
    public function delete(string $id): bool;
    public function getAll(): array;
    public function getById(string $id): ?Contrato;
    //public function getBySei(string $sei): ?Contrato;
    public function count(): int;
}




?>