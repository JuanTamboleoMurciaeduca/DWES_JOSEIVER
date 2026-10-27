<?php

declare(strict_types=1);

// Ejercicio 23. Argumentos nombrados
// Crea una función ficha(string $titulo, string $autor): string y llámala usando argumentos nombrados 
// en un orden distinto al declarado. Muestra el texto resultante.

function ficha(string $titulo, string $autor): string
{
    return "Título: $titulo | Autor: $autor";
}

// Llamada utilizando argumentos nombrados en orden inverso al declarado en la firma
$resultado = ficha(
    autor: 'Frank Herbert',
    titulo: 'Dune'
);

echo "Resultado de la llamada con argumentos nombrados:" . PHP_EOL;
echo $resultado . PHP_EOL;
