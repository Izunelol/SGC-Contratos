<?php 
require __DIR__ . '/../vendor/autoload.php';

use Src\App\Services\ExtratorContratoService;


$teste = new ExtratorContratoService;

$caminhoPDF = "C:\Users\E324335\Downloads\contrato_teste.pdf";

$resposta = $teste->extrair($caminhoPDF);

var_dump($resposta);
?>