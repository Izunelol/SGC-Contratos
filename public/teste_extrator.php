<?php 
require __DIR__ . '/../vendor/autoload.php';

use Src\App\Services\ExtratorContratoService;


$teste = new ExtratorContratoService;

$texto = $teste->lerTexto("C:\Users\E324335\Downloads\contrato_teste_ambiguo.pdf");

$texto2 = $teste->montarPrompt($texto);

$resposta = $teste->consultarModelo($texto2);

$respostaDados = $teste->decodificarJson($resposta);

var_dump($respostaDados);
?>