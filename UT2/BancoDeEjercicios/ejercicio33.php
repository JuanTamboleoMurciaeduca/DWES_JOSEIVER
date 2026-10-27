<?php

declare(strict_types=1);

final class Libro
{
    public function __construct(public string $titulo) {}
}

$original = new Libro('Dune');
$alias = $original;
$otro = new Libro('Dune');
$alias->titulo = 'Solaris';

echo $original->titulo . PHP_EOL;
echo $otro->titulo . PHP_EOL;

var_dump($original === $alias);
var_dump($original === $otro);
