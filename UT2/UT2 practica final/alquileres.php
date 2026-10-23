<?php
require_once __DIR__ .'vendor\composer\autoload_psr4.php';

$alquileres = [];

function mostrar(string $titulo, array $alquileres,
 ServicioAlquileres $servicio): void
{
 echo $titulo . PHP_EOL;
 if ($alquileres === []) {
 echo 'Sin resultados' . PHP_EOL;
 }
 foreach ($alquileres as $a) {
 echo $a->id() . ' | ' . $a->cliente() . ' | ' . $a->modalidad()
 . ' | días: ' . $a->dias() . ' | ' . $a->estado()->value
 . ' | ' . $a->importe() . ' céntimos' . PHP_EOL;
 }
 $resumen = $servicio->resumir($alquileres);
 echo 'Cantidad: ' . $resumen['cantidad']
 . ' | Importe: ' . $resumen['importe'] . ' céntimos'
 . PHP_EOL . PHP_EOL;
}
