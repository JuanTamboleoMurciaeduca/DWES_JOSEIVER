<?php

declare(strict_types=1);

// Ejercicio 25. Destructuración de arrays
// Dado un array asociativo con titulo y autor, usa destructuración para guardar ambos valores en $t y 
// $a. Muestra después una cadena con el formato 'Dune / Frank Herbert'.

$libro = [
    'titulo' => 'Dune',
    'autor' => 'Frank Herbert',
];

// Destructuración por clave asociativa
['titulo' => $t, 'autor' => $a] = $libro;

echo "$t / $a" . PHP_EOL;
