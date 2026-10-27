<?php

declare(strict_types=1);

$codigo = 'LIB-2026-0042';

$prefijo = substr($codigo, 0, 3);
$sufijo = substr($codigo, -4);

echo "Prefijo: $prefijo" . PHP_EOL;
echo "Sufijo: $sufijo" . PHP_EOL;

$palabra = 'Drácula';
$tresCaracteres = mb_substr($palabra, 0, 3, 'UTF-8');

echo "Tres primeros caracteres: $tresCaracteres" . PHP_EOL;
