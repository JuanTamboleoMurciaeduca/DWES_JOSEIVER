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

// Búsqueda 1: ' DRÁ '
$busqueda1 = mb_strtolower(trim(' DRÁ '), 'UTF-8');

$filtrados1 = array_filter(
    $libros,
    fn (Libro $libro): bool => str_contains(
        mb_strtolower($libro->titulo, 'UTF-8'),
        $busqueda1
    )
);

$etiquetas1 = array_map(
    fn (Libro $libro): string => "{$libro->titulo} - {$libro->paginas} páginas",
    $filtrados1
);

echo count($etiquetas1) > 0 ? implode(PHP_EOL, $etiquetas1) . PHP_EOL : "Sin resultados" . PHP_EOL;

// Búsqueda 2: sin resultados
$busqueda2 = mb_strtolower(trim(' quijote '), 'UTF-8');

$filtrados2 = array_filter(
    $libros,
    fn (Libro $libro): bool => str_contains(
        mb_strtolower($libro->titulo, 'UTF-8'),
        $busqueda2
    )
);

$etiquetas2 = array_map(
    fn (Libro $libro): string => "{$libro->titulo} - {$libro->paginas} páginas",
    $filtrados2
);

echo count($etiquetas2) > 0 ? implode(PHP_EOL, $etiquetas2) . PHP_EOL : "Sin resultados" . PHP_EOL;
