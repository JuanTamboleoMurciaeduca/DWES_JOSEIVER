<?php

declare(strict_types=1);

$libros = [
    ['titulo' => 'Dune', 'paginas' => 412],
    ['titulo' => 'Solaris', 'paginas' => 216],
    ['titulo' => '1984', 'paginas' => 328],
    ['titulo' => 'Drácula', 'paginas' => 418],
];

$totalPaginas = array_reduce(
    $libros,
    function (int $acumulador, array $libro): int {
        $nuevo = $acumulador + $libro['paginas'];
        echo "Paso: $acumulador + {$libro['paginas']} => $nuevo" . PHP_EOL;
        return $nuevo;
    },
    0
);

echo "Total: $totalPaginas" . PHP_EOL;
