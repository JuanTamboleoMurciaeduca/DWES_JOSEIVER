<?php

declare(strict_types=1);

// Ejercicio 1. Callable y callback
// Crea una función aplicar(int $n, callable $callback): int. Úsala primero con una función doble(int $n): int 
// y después con otra función cuadrado(int $n): int. Indica qué valor devuelve cada llamada.

function doble(int $n): int
{
    return $n * 2;
}

function cuadrado(int $n): int
{
    return $n * $n;
}

function aplicar(int $n, callable $callback): int
{
    return $callback($n);
}

$resultadoDoble = aplicar(5, 'doble');
$resultadoCuadrado = aplicar(5, 'cuadrado');

echo "aplicar(5, 'doble') devuelve: " . $resultadoDoble . PHP_EOL;
echo "aplicar(5, 'cuadrado') devuelve: " . $resultadoCuadrado . PHP_EOL;
