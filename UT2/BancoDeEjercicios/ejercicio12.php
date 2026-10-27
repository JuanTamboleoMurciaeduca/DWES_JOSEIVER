<?php

declare(strict_types=1);

// Ejercicio 12. array_column
// A partir de una colección de libros, obtén primero un array solo con sus títulos. Después crea otro 
// array indexado por id que conserve el registro completo de cada libro usando array_column.

$libros = [
    ['id' => 10, 'titulo' => 'Dune', 'paginas' => 412],
    ['id' => 20, 'titulo' => 'Drácula', 'paginas' => 418],
    ['id' => 30, 'titulo' => '1984', 'paginas' => 328],
];

// 1. Array solo con sus títulos
$titulos = array_column($libros, 'titulo');
echo "Títulos extraídos con array_column:" . PHP_EOL;
print_r($titulos);

// 2. Array indexado por 'id' que conserva el registro completo (usando null como columna)
$librosPorId = array_column($libros, null, 'id');
echo "Libros indexados por 'id' con registro completo:" . PHP_EOL;
print_r($librosPorId);
