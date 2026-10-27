<?php

declare(strict_types=1);

class Libro
{
    public function __construct(
        public int $id,
        public string $titulo,
        public int $paginas,
        public bool $disponible = true,
    ) {}
}

function seleccionarDesdeEntrada(array $libros, mixed $entrada): array
{
    $entero = is_string($entrada) ? filter_var($entrada, FILTER_VALIDATE_INT) : false;

    if ($entero === false || $entero < 1) {
        echo "Entrada no válida" . PHP_EOL;
        return [];
    }

    $maximo = (int) $entero;

    $seleccionados = array_values(array_filter(
        $libros,
        fn (Libro $l): bool => $l->disponible && $l->paginas <= $maximo
    ));

    if (empty($seleccionados)) {
        echo "Sin coincidencias" . PHP_EOL;
        return [];
    }

    $titulos = array_map(fn (Libro $l): string => $l->titulo, $seleccionados);
    $hayMasDe400 = array_any($seleccionados, fn (Libro $l): bool => $l->paginas > 400);
    $todosPositivos = array_all($seleccionados, fn (Libro $l): bool => $l->paginas > 0);

    echo "Títulos: " . implode(', ', $titulos) . PHP_EOL;
    echo "> 400 págs: " . ($hayMasDe400 ? 'Sí' : 'No') . PHP_EOL;
    echo "Todas positivas: " . ($todosPositivos ? 'Sí' : 'No') . PHP_EOL;

    return $seleccionados;
}

$datos = [
    ['id' => 10, 'titulo' => 'Dune', 'paginas' => 412, 'disponible' => true],
    ['id' => 20, 'titulo' => 'Drácula', 'paginas' => 418, 'disponible' => false],
    ['id' => 30, 'titulo' => '1984', 'paginas' => 328, 'disponible' => true],
    ['id' => 40, 'titulo' => 'It', 'paginas' => 1504, 'disponible' => true],
];

$libros = array_map(
    fn (array $d): Libro => new Libro($d['id'], $d['titulo'], $d['paginas'], $d['disponible']),
    $datos
);

$entradas = ['500', '0', 'abc', ['500'], '100'];

foreach ($entradas as $entrada) {
    seleccionarDesdeEntrada($libros, $entrada);
}
