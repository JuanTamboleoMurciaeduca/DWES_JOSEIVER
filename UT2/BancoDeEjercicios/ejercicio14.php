<?php

declare(strict_types=1);

$libros = [
    'a' => ['titulo' => 'Dune', 'paginas' => 412],
    'b' => ['titulo' => 'Solaris', 'paginas' => 216],
    'c' => ['titulo' => 'It', 'paginas' => 1504],
    'd' => ['titulo' => '1984', 'paginas' => 328],
];

// Menor a mayor
$ascendente = $libros;
usort($ascendente, fn (array $a, array $b): int => $a['paginas'] <=> $b['paginas']);
print_r($ascendente);
print_r(array_keys($ascendente));

// Mayor a menor
$descendente = $libros;
usort($descendente, fn (array $a, array $b): int => $b['paginas'] <=> $a['paginas']);
print_r($descendente);
print_r(array_keys($descendente));
