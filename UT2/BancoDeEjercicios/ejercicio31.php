<?php

declare(strict_types=1);

final class Libro
{
    public function __construct(
        public string $titulo,
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

$dune = new Libro('Dune');
$solaris = new Libro('Solaris');

$dune->prestar();

echo "Tras prestar Dune:" . PHP_EOL;
echo "Dune disponible: " . ($dune->disponible ? 'true' : 'false') . PHP_EOL;
echo "Solaris disponible: " . ($solaris->disponible ? 'true' : 'false') . PHP_EOL;

$dune->devolver();

echo "Tras devolver Dune:" . PHP_EOL;
echo "Dune disponible: " . ($dune->disponible ? 'true' : 'false') . PHP_EOL;
echo "Solaris disponible: " . ($solaris->disponible ? 'true' : 'false') . PHP_EOL;
