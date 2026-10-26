<?php

declare(strict_types=1);

$libros = [
    ['id' => 1, 'titulo' => 'Dune'],
    ['id' => 2, 'titulo' => 'Solaris'],
    ['id' => 3, 'titulo' => '1984'],
    ['id' => 4, 'titulo' => 'Drácula'],
];

$libro3 = array_find($libros, fn (array $libro): bool => $libro['id'] === 3);

echo $libro3 !== null ? "Título: {$libro3['titulo']}" . PHP_EOL : "No existe el libro con id 3" . PHP_EOL;

$libroNull = array_find($libros, fn (array $libro): bool => $libro['id'] === 99);

echo $libroNull !== null ? "Título: {$libroNull['titulo']}" . PHP_EOL : "Búsqueda id 99: null" . PHP_EOL;
