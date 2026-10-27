<?php

declare(strict_types=1);

function mostrar(mixed $valor): string
{
    return is_bool($valor)
        ? ($valor ? 'true' : 'false')
        : (string) $valor;
}

echo "mostrar(true): " . mostrar(true) . PHP_EOL;
echo "mostrar(42): " . mostrar(42) . PHP_EOL;
echo "mostrar('Dune'): " . mostrar('Dune') . PHP_EOL;
