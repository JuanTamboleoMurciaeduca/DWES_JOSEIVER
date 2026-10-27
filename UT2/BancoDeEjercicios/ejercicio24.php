<?php

declare(strict_types=1);

// Ejercicio 24. Tipos unión y nullable
// Crea normalizarId(int|string $id): int y etiqueta(?string $titulo): string. Prueba la primera con un 
// entero y una cadena numérica, y la segunda con un título y con null.

function normalizarId(int|string $id): int
{
    return (int) $id;
}

function etiqueta(?string $titulo): string
{
    return $titulo !== null ? "Título: $titulo" : "Sin título";
}

// Pruebas de normalizarId con int y con string numérico
$idEntero = normalizarId(42);
$idCadena = normalizarId('105');

echo "normalizarId(42): $idEntero (tipo: " . gettype($idEntero) . ")" . PHP_EOL;
echo "normalizarId('105'): $idCadena (tipo: " . gettype($idCadena) . ")" . PHP_EOL;

// Pruebas de etiqueta con un string y con null
$etiquetaConTitulo = etiqueta('Dune');
$etiquetaConNull = etiqueta(null);

echo "etiqueta('Dune'): $etiquetaConTitulo" . PHP_EOL;
echo "etiqueta(null): $etiquetaConNull" . PHP_EOL;
