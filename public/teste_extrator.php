<?php 
require __DIR__ . '/../vendor/autoload.php';

use Src\App\Services\ExtratorContratoService;


$teste = new ExtratorContratoService;

$texto = $teste->lerTexto("C:\Apache24\htdocs\Estudo\Teste LLPhant\contrato_exemplo.pdf");

$texto2 = $teste->montarPrompt($texto);

$resposta = $teste->consultarModelo($texto2);

var_dump($resposta);
?>