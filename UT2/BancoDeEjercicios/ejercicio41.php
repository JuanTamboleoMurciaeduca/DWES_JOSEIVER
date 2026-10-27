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

    public function prestar(): void
    {
        $this->disponible = false;
    }

    public function devolver(): void
    {
        $this->disponible = true;
    }
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

// Colección de disponibles inicial
$disponiblesAntes = array_filter($libros, fn (Libro $l): bool => $l->disponible);

// Localizar libro con id 10 y prestarlo
$libro10 = array_find($libros, fn (Libro $l): bool => $l->id === 10);
$libro10?->prestar();

$duneEnColeccion = array_find($libros, fn (Libro $l): bool => $l->id === 10);
echo "Disponible en \$libro10: " . ($libro10?->disponible ? 'true' : 'false') . PHP_EOL;
echo "Disponible en \$libros: " . ($duneEnColeccion?->disponible ? 'true' : 'false') . PHP_EOL;

$duneEnDisponiblesAntes = array_find($disponiblesAntes, fn (Libro $l): bool => $l->id === 10);
echo "Disponible en \$disponiblesAntes: " . ($duneEnDisponiblesAntes?->disponible ? 'true' : 'false') . PHP_EOL;

// Filtrar lista actualizada
$disponiblesDespues = array_filter($libros, fn (Libro $l): bool => $l->disponible);
foreach ($disponiblesDespues as $l) {
    echo "Disponible: {$l->titulo}" . PHP_EOL;
}

// Búsqueda con id 99
$libro99 = array_find($libros, fn (Libro $l): bool => $l->id === 99);
echo ($libro99?->titulo ?? 'Libro no encontrado') . PHP_EOL;
