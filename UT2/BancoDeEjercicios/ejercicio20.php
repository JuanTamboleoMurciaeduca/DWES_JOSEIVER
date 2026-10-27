<?php

declare(strict_types=1);

// Ejercicio 20. preg_replace
// Normaliza una cadena que contiene varios espacios, tabulaciones o saltos de línea consecutivos, 
// sustituyéndolos por un único espacio mediante preg_replace y el patrón /\s+/.

$textoOriginal = "Este   texto\t\ttiene\n\n  espacios,   saltos\r\nde línea y\ttabulaciones.";

$textoNormalizado = preg_replace('/\s+/', ' ', trim($textoOriginal));

echo "Texto original:" . PHP_EOL;
echo var_export($textoOriginal, true) . PHP_EOL . PHP_EOL;

echo "Texto normalizado con preg_replace('/\s+/', ' ', ...):" . PHP_EOL;
echo var_export($textoNormalizado, true) . PHP_EOL;
