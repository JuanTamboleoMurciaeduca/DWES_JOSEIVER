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
    fn (array $registro): Libro => new Libro(
        titulo: $registro['titulo'],
        id: $registro['id'],
        disponible: $registro['disponible'],
        paginas: $registro['paginas']
    ),
    $datos
);

foreach ($libros as $libro) {
    echo "ID: {$libro->id} | Título: {$libro->titulo} | Páginas: {$libro->paginas}" . PHP_EOL;
}

echo "Total objetos creados: " . count($libros) . PHP_EOL;
var_dump(is_array($datos[0]));
