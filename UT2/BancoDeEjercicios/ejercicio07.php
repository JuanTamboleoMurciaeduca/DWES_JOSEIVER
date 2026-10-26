<?php

declare(strict_types=1);

$libros = [
    ['titulo' => 'Dune', 'paginas' => 412, 'disponible' => true],
    ['titulo' => 'Solaris', 'paginas' => 216, 'disponible' => false],
    ['titulo' => '1984', 'paginas' => 328, 'disponible' => true],
];

// 1. Mostrar varios datos por libro: foreach
foreach ($libros as $libro) {
    echo "{$libro['titulo']} - {$libro['paginas']} páginas" . PHP_EOL;
}

// 2. Seleccionar disponibles: array_filter
$disponibles = array_filter($libros, fn (array $l): bool => $l['disponible']);

// 3. Convertir títulos en etiquetas: array_map
$etiquetas = array_map(fn (array $l): string => "Libro: {$l['titulo']}", $libros);

// 4. Sumar páginas: array_reduce
$totalPaginas = array_reduce($libros, fn (int $acum, array $l): int => $acum + $l['paginas'], 0);

echo "Total páginas: $totalPaginas" . PHP_EOL;
