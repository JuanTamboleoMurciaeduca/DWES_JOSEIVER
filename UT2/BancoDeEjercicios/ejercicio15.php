<?php

declare(strict_types=1);

$catalogo = [
    10 => ['titulo' => 'Solaris', 'paginas' => 216],
    20 => ['titulo' => 'Dune', 'paginas' => 412],
    30 => ['titulo' => '1984', 'paginas' => 328],
];

uasort($catalogo, fn (array $a, array $b): int => $a['titulo'] <=> $b['titulo']);

print_r($catalogo);
print_r(array_keys($catalogo));
