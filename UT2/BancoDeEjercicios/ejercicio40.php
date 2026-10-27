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

// Menor a mayor
usort($libros, fn (Libro $a, Libro $b): int => $a->paginas <=> $b->paginas);

$totalPaginas = array_reduce(
    $libros,
    fn (int $acum, Libro $libro): int => $acum + $libro->paginas,
    0
);

echo "--- Ascendente ---" . PHP_EOL;
foreach ($libros as $clave => $l) {
    echo "[$clave] ID: {$l->id} - {$l->titulo} ({$l->paginas} págs)" . PHP_EOL;
}
echo "Total: $totalPaginas" . PHP_EOL . PHP_EOL;

// Mayor a menor
usort($libros, fn (Libro $a, Libro $b): int => $b->paginas <=> $a->paginas);

echo "--- Descendente ---" . PHP_EOL;
foreach ($libros as $clave => $l) {
    echo "[$clave] ID: {$l->id} - {$l->titulo} ({$l->paginas} págs)" . PHP_EOL;
}
