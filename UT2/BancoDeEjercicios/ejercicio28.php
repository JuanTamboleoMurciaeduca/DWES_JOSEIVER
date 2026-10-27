<?php

declare(strict_types=1);

class Libro
{
    public string $titulo;
    public string $autor;
    public int $paginas;
    public bool $disponible;

    public function __construct(string $titulo, string $autor, int $paginas, bool $disponible)
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->paginas = $paginas;
        $this->disponible = $disponible;
    }
}

$datos = [
    'titulo' => 'Dune',
    'autor' => 'Frank Herbert',
    'paginas' => 412,
    'disponible' => true,
];

$libro = new Libro(
    $datos['titulo'],
    $datos['autor'],
    $datos['paginas'],
    $datos['disponible']
);

echo "Título: " . $libro->titulo . PHP_EOL;
echo "Autor: " . $libro->autor . PHP_EOL;
echo "Páginas: " . $libro->paginas . PHP_EOL;
echo "Disponible: " . ($libro->disponible ? 'Sí' : 'No') . PHP_EOL;
