<?php

declare(strict_types=1);

$inventario = [
    'Dune' => 5,
    'Solaris' => 0,
    '1984' => 2,
    'Drácula' => 0,
];

$primerAgotado = array_find_key($inventario, fn (int $ejemplares): bool => $ejemplares === 0);
echo $primerAgotado !== null ? "Primer libro con 0 ejemplares: $primerAgotado" . PHP_EOL : "No hay libros agotados" . PHP_EOL;

$inventarioCompleto = [
    'Dune' => 5,
    'Solaris' => 3,
];

$ninguno = array_find_key($inventarioCompleto, fn (int $ejemplares): bool => $ejemplares === 0);
var_dump($ninguno);
