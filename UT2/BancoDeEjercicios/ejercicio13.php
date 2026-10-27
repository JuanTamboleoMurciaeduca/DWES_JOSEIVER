<?php

declare(strict_types=1);

$generos = ['terror', 'fantasía', 'terror', 'ciencia ficción', 'fantasía'];
$generosUnicos = array_values(array_unique($generos));

print_r($generosUnicos);

$claves = ['titulo', 'autor', 'paginas', 'disponible'];
$valores = ['Dune', 'Frank Herbert', 412, true];

$libro = array_combine($claves, $valores);

print_r($libro);
