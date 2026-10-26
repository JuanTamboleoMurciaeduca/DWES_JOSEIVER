<?php

declare(strict_types=1);

// Ejercicio 22. Variádicas y unpacking
// Crea sumarPaginas(int ...$paginas): int. Después llama a la función desempaquetando un array de 
// páginas con ... y comprueba que el resultado coincide con pasar los valores uno a uno.

function sumarPaginas(int ...$paginas): int
{
    return array_sum($paginas);
}

$arrayPaginas = [412, 216, 328, 418];

// 1. Llamada desempaquetando con el operador splat (...)
$resultadoDesempaquetado = sumarPaginas(...$arrayPaginas);

// 2. Llamada pasando los valores uno a uno
$resultadoUnoAUno = sumarPaginas(412, 216, 328, 418);

echo "Resultado desempaquetando array: $resultadoDesempaquetado" . PHP_EOL;
echo "Resultado pasando valores uno a uno: $resultadoUnoAUno" . PHP_EOL;

echo $resultadoDesempaquetado === $resultadoUnoAUno
    ? "Comprobación correcta: Ambos resultados coinciden exactamente." . PHP_EOL
    : "Error: Los resultados no coinciden." . PHP_EOL;
