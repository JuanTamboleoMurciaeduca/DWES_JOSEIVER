<?php

declare(strict_types=1);

final class Libro
{
    public function __construct(
        public string $titulo,
        public int $paginas,
    ) {
        if (trim($titulo) === '' || $paginas <= 0) {
            throw new InvalidArgumentException('Datos inválidos');
        }
    }
}

$pruebas = [
    ['titulo' => 'Dune', 'paginas' => 412],
    ['titulo' => '   ', 'paginas' => 100],
    ['titulo' => 'Solaris', 'paginas' => 0],
    ['titulo' => 'Solaris', 'paginas' => -5],
];

foreach ($pruebas as $p) {
    try {
        $instancia = new Libro($p['titulo'], $p['paginas']);
        echo "Objeto creado: {$instancia->titulo} ({$instancia->paginas} páginas)" . PHP_EOL;
    } catch (InvalidArgumentException $e) {
        echo "Excepción capturada: " . $e->getMessage() . PHP_EOL;
    }
}
