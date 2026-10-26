<?php

declare(strict_types=1);

final class Libro
{
    public string $titulo;
    public int $paginas = 0;
    public bool $disponible = true;
}

$libro = new Libro();

$libro->titulo = 'Solaris';
$libro->paginas = 216;

echo "Título: " . $libro->titulo . PHP_EOL;
echo "Páginas: " . $libro->paginas . PHP_EOL;
echo "Disponible: " . ($libro->disponible ? 'true' : 'false') . PHP_EOL;
