<?php

declare(strict_types=1);

class Autor
{
    public function __construct(
        public string $nombre
    ) {}
}

class Categoria
{
    public function __construct(
        public string $nombre
    ) {}
}

class Libro
{
    public function __construct(
        public string $titulo,
        public Autor $autor,
        public Categoria $categoria
    ) {}
}

$autor = new Autor('Frank Herbert');
$categoria = new Categoria('Ciencia ficción');

$libro = new Libro('Dune', $autor, $categoria);

echo "Título: " . $libro->titulo . PHP_EOL;
echo "Autor: " . $libro->autor->nombre . PHP_EOL;
echo "Categoría: " . $libro->categoria->nombre . PHP_EOL;
