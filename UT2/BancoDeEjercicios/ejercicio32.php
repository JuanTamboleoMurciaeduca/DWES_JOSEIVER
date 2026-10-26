<?php

declare(strict_types=1);

class Libro
{
    public function __construct(
        public string $titulo,
        public int $paginas
    ) {}

    public function ficha(): string
    {
        return "{$this->titulo} - {$this->paginas} páginas";
    }

    public function mostrarFicha(): void
    {
        echo $this->ficha() . PHP_EOL;
    }
}

$libro = new Libro('Dune', 412);

$textoFicha = $libro->ficha();
echo "Ficha: $textoFicha" . PHP_EOL;

$libro->mostrarFicha();
