<?php

declare(strict_types=1);

// Ejercicio 10. array_any y array_all
// Con un array de páginas, comprueba con array_any si existe algún libro con más de 1000 páginas y 
// con array_all si todos tienen un número de páginas mayor que 0.

$paginas = [412, 216, 1504, 328, 418];

$hayLibroLargo = array_any($paginas, fn (int $p): bool => $p > 1000);
$todosPositivos = array_all($paginas, fn (int $p): bool => $p > 0);

echo $hayLibroLargo 
    ? "array_any: Sí existe al menos un libro con más de 1000 páginas." . PHP_EOL 
    : "array_any: No existe ningún libro con más de 1000 páginas." . PHP_EOL;

echo $todosPositivos 
    ? "array_all: Todos los libros tienen un número de páginas mayor que 0." . PHP_EOL 
    : "array_all: No todos los libros tienen páginas mayores que 0." . PHP_EOL;
