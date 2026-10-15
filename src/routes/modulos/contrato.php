<?php 

declare(strict_types=1);

use Src\App\Http\Controllers\ContratoController;
use Src\App\Http\Middleware\AuthMiddleware;

$router->get('/contrato', [ContratoController::class, 'index'], [AuthMiddleware::class]);
$router->get('/contrato/criar', [ContratoController::class, 'criar'], [AuthMiddleware::class]);
$router->get('/contrato/editar', [ContratoController::class, 'editar'], [AuthMiddleware::class]);
$router->post('/contrato/salvar', [ContratoController::class, 'salvar'], [AuthMiddleware::class]);
$router->post('/contrato/atualizar', [ContratoController::class, 'atualizar'], [AuthMiddleware::class]);
$router->post('/contrato/deletar', [ContratoController::class, 'deletar'], [AuthMiddleware::class]);
$router->post('/contrato/extrair', [ContratoController::class, 'extrair'], [AuthMiddleware::class]);



?>