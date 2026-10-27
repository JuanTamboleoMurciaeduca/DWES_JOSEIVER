<?php

declare(strict_types=1);

$factor = 3;

$multiplicar = fn (int $n): int => $n * $factor;

$numero = 4;
$resultado = $multiplicar($numero);

echo "Resultado: $resultado" . PHP_EOL;
