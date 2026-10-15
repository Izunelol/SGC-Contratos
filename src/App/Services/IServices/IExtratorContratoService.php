<?php 

declare(strict_types=1);

namespace Src\App\Services\IServices;


interface IExtratorContratoService
{

    public function extrair(string $caminhoPDF): array;
    public function extrairDeUpload(array $arquivo): array;

}




?>