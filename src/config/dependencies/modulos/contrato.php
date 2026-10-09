<?php

declare(strict_types=1);

use Src\App\Http\Controllers\ContratoController;
use Src\App\Infrastructure\IRepositories\IContratoRepository;
use Src\App\Infrastructure\Repositories\ContratoRepository;
use Src\App\Services\Auditoria\AuditoriaContrato;
use Src\App\Services\ContratoService;
use Src\App\Services\IServices\IAuditoriaService;
use Src\App\Services\IServices\IContratoService;
use Src\Core\Container;
use Src\Core\Database;


// =====================
// REPOSITORIES
// =====================
Container::set(IContratoRepository::class, static function () {
    return new AuditoriaContrato(
        new ContratoRepository(Container::get(Database::class)),
        Container::get(IAuditoriaService::class)
    );
});

// =====================
// SERVICES
// =====================
Container::set(IContratoService::class, static function () {
    return new ContratoService(
        Container::get(IContratoRepository::class)
    );
});

// =====================
// CONTROLLERS
// =====================
Container::set(ContratoController::class, static function () {
    return new ContratoController(
        Container::get(IContratoService::class)
    );
});
