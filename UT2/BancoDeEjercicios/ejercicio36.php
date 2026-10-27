<?php

declare(strict_types=1);

class Autor
{
    public function __construct(
        public string $nombre
    ) {}
}

final class Libro
{
    public function __construct(
        public string $titulo,
        public ?Autor $autor = null,
    ) {}
}

$conAutor = new Libro('Dune', new Autor('Frank Herbert'));
$sinAutor = new Libro('Relato anónimo');

$autorCon = $conAutor->autor?->nombre ?? 'Sin autor';
$autorSin = $sinAutor->autor?->nombre ?? 'Sin autor';

echo "Libro: '{$conAutor->titulo}' | Autor: $autorCon" . PHP_EOL;
echo "Libro: '{$sinAutor->titulo}' | Autor: $autorSin" . PHP_EOL;
