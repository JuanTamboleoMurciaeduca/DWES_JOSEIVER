<?php

declare(strict_types=1);

$texto = 'Desarrollo Web con PHP';

$contienePhp = str_contains($texto, 'PHP');
$posicionPhp = strpos($texto, 'PHP');

echo $contienePhp ? "Contiene 'PHP'" . PHP_EOL : "No contiene 'PHP'" . PHP_EOL;
echo $posicionPhp !== false ? "Posición 'PHP': $posicionPhp" . PHP_EOL : "No encontrado" . PHP_EOL;

$posicionDesarrollo = strpos($texto, 'Desarrollo');
echo $posicionDesarrollo !== false ? "Posición 'Desarrollo': $posicionDesarrollo" . PHP_EOL : "No encontrado" . PHP_EOL;
