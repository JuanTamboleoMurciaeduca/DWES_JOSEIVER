<?php

declare(strict_types=1);

$catalogo = [
    ['titulo' => 'Dune', 'disponible' => true],
    ['titulo' => 'Solaris', 'disponible' => false],
    ['titulo' => '1984', 'disponible' => true],
    ['titulo' => 'Drácula', 'disponible' => false],
];

$disponibles = array_filter($catalogo, fn (array $libro): bool => $libro['disponible']);

print_r($disponibles);
print_r(array_keys($disponibles));
