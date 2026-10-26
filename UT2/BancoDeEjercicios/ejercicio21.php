<?php

declare(strict_types=1);

$texto = '  El libro de PHP en la biblioteca  ';

// 1. Saber si aparece una palabra: str_contains
$contiene = str_contains($texto, 'PHP');

// 2. Conocer su posición: strpos
$posicion = strpos($texto, 'PHP');

// 3. Comprobar un prefijo: str_starts_with
$empieza = str_starts_with(trim($texto), 'El');

// 4. Comprobar un sufijo: str_ends_with
$termina = str_ends_with(trim($texto), 'biblioteca');

// 5. Validar un formato con patrón: preg_match
$esValido = preg_match('/^LIB-\d{4}$/', 'LIB-2026');

// 6. Sustituir espacios repetidos: preg_replace
$limpio = preg_replace('/\s+/', ' ', trim($texto));

// 7. Trabajar con texto UTF-8: funciones mb_*
$longitudUtf8 = mb_strlen('Camión', 'UTF-8');
$minusculasUtf8 = mb_strtolower('CAMIÓN', 'UTF-8');

var_dump($contiene, $posicion, $empieza, $termina, $esValido, $limpio, $longitudUtf8, $minusculasUtf8);
