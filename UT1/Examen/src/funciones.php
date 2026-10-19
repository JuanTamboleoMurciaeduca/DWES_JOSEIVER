<?php

declare(strict_types=1);

function normalizarTexto(string $texto): string
{
    $textoLimpio = strtolower(trim($texto));
    return $textoLimpio;// Mira ver socio
}



function buscarPorId(array $videojuegos, int $id): ?array
{
    // No sé bien qué pasa?¿
    foreach ($videojuegos as $videojuego) {
        if ($videojuego['id'] === $id) {
            return $videojuego;
        }
    }

    return null;
}



function filtrarPorGenero(array $videojuegos, string $genero): array
{
    $resultado = [];

    // Foreach y qué más¿?
    foreach ($videojuegos as $videojuego) {
        // COMPLETAR
        if ($videojuego['genero'] === $genero) {
            $resultado[] = $videojuego;
        }
    }

    return $resultado;
}

function filtrarPorPlataforma(array $videojuegos, string $plataforma): array
{
    $resultado = [];

    foreach ($videojuegos as $videojuego) {
        if ($videojuego['plataforma'] === $plataforma) {
            $resultado[] = $videojuego;
        }
    }
    // COMPLETAR
    return $resultado;
}

function buscarPorTexto(array $videojuegos, string $texto): array
{
    $resultado = [];
    $texto = normalizarTexto($texto);

    if ($texto === '') {
        return $videojuegos; // revissar esto en casa 
    }

    foreach ($videojuegos as $videojuego) {
        $titulo = normalizarTexto($videojuego['titulo']);
        $estudio = normalizarTexto($videojuego['estudio']);

        // Esta función está implementada, pero su lógica no produce todos los resultados esperados.
        if (str_contains($titulo, $texto) || str_contains($estudio, $texto)) {
            $resultado[] = $videojuego;
        }
    }

    return $resultado;
}


function ordenarVideojuegos(array $videojuegos, string $criterio): array
{
    $criterio = normalizarTexto($criterio);
    $cantidad = count($videojuegos);

    for ($i = 0; $i < $cantidad; $i++) {
        for ($j = 0; $j < $cantidad - 1; $j++) {
            $actual = $videojuegos[$j];
            $siguiente = $videojuegos[$j + 1];

            $intercambiar = false;
            if($actual[$criterio] > $siguiente[$criterio]){
                $intercambiar = true;
            }

            if ($intercambiar) {
                $temporal = $videojuegos[$j];
                $videojuegos[$j] = $videojuegos[$j + 1];
                $videojuegos[$j + 1] = $temporal;
            }
        }
    }

    return $videojuegos;
}
