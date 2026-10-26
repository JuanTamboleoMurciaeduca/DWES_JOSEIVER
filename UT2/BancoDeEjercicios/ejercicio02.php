<?php

declare(strict_types=1);

// Ejercicio 2. Closure con use
// Crea una función anónima que calcule el precio final de un libro capturando una variable externa 
// $iva mediante use. Prueba la closure con un precio de 100.0 y muestra el resultado.

$iva = 0.21;

$calcularPrecioFinal = function (float $precioBase) use ($iva): float {
    return $precioBase * (1 + $iva);
};

$precioLibro = 100.0;
$precioFinal = $calcularPrecioFinal($precioLibro);

echo "Precio base: $precioLibro €, IVA: " . ($iva * 100) . "%, Precio final: $precioFinal €" . PHP_EOL;
