<?php

declare(strict_types=1);

// Ejercicio 18. Normalización UTF-8
// Normaliza la cadena ' DRÁCULA ': elimina espacios externos con trim, conviértela a minúsculas 
// con mb_strtolower y calcula su longitud con mb_strlen. Muestra el resultado de cada paso.

$cadenaOriginal = ' DRÁCULA ';
echo "Cadena original: '$cadenaOriginal'" . PHP_EOL;

// Paso 1: Eliminar espacios externos con trim
$cadenaTrim = trim($cadenaOriginal);
echo "Paso 1 (trim): '$cadenaTrim'" . PHP_EOL;

// Paso 2: Convertir a minúsculas respetando UTF-8
$cadenaMinusculas = mb_strtolower($cadenaTrim, 'UTF-8');
echo "Paso 2 (mb_strtolower): '$cadenaMinusculas'" . PHP_EOL;

// Paso 3: Calcular longitud con mb_strlen
$longitud = mb_strlen($cadenaMinusculas, 'UTF-8');
echo "Paso 3 (mb_strlen): $longitud caracteres" . PHP_EOL;
