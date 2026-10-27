<?php

declare(strict_types=1);

$libros = [
    ['id' => 1, 'titulo' => 'Dune', 'paginas' => 412],
    ['id' => 2, 'titulo' => 'It', 'paginas' => 1504],
];

$busqueda = mb_strtolower(trim(' dune '), 'UTF-8');

$visibles = array_filter(
    $libros,
    fn (array $l): bool => str_contains(
        mb_strtolower($l['titulo'], 'UTF-8'),
        $busqueda
    )
);

usort($libros, fn (array $a, array $b): int => $a['paginas'] <=> $b['paginas']);

$titulos = array_column($libros, 'titulo');

$etiquetas = array_map(fn (string $t): string => "Libro: $t", $titulos);

print_r($visibles);
print_r($etiquetas);

$libroId2 = array_find($libros, fn (array $l): bool => $l['id'] === 2);
print_r($libroId2);
