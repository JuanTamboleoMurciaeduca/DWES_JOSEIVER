<?php

declare(strict_types=1);

$generos = ['terror', 'ciencia ficción', 'fantasía', 'histórico'];

$clave = array_search('terror', $generos, true);

echo $clave !== false ? "Clave: $clave" . PHP_EOL : "No encontrado" . PHP_EOL;

$claveInexistente = array_search('romance', $generos, true);

echo $claveInexistente !== false ? "Clave: $claveInexistente" . PHP_EOL : "No encontrado" . PHP_EOL;
