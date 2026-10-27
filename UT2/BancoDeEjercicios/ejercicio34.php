<?php

declare(strict_types=1);

final class Libro
{
    public string $titulo;
    public bool $disponible;

    public function __construct(string $titulo)
    {
        $this->titulo = $titulo;
        $this->disponible = true;
    }

    public function prestar(): void
    {
        $this->disponible = false;
    }
}

$libro = new Libro('Dune');

echo "Disponible inicialmente: " . ($libro->disponible ? 'true' : 'false') . PHP_EOL;

$libro->prestar();

echo "Disponible tras prestar(): " . ($libro->disponible ? 'true' : 'false') . PHP_EOL;
