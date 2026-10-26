<?php

declare(strict_types=1);

final class Libro
{
    public function __construct(
        public string $titulo,
        public bool $disponible = true
    ) {}
}

$libro1 = new Libro('Dune');
$libro2 = new Libro('Solaris', false);

echo "Libro 1: Título: {$libro1->titulo}, Disponible: " . ($libro1->disponible ? 'true' : 'false') . PHP_EOL;
echo "Libro 2: Título: {$libro2->titulo}, Disponible: " . ($libro2->disponible ? 'true' : 'false') . PHP_EOL;
