<?php

use Clase\Alquileres\Excepcion\AlquilerException;
use Clase\Alquileres\Modelo\AlquilerBicicleta;
use Clase\Alquileres\Modelo\AlquilerPatinete;
use Clase\Alquileres\Modelo\Alquiler;
use Clase\Alquileres\Modelo\EstadoAlquiler;
use Clase\Alquileres\Servicio\ServicioAlquileres;


require_once __DIR__ . '/../vendor/autoload.php';

$alquiler1 = new AlquilerBicicleta(501, 'Lucía Torres', 2, EstadoAlquiler::Reservado);
$alquiler2 = new AlquilerPatinete(502, 'Álex Ruiz', 2, EstadoAlquiler::Activo);
$alquiler3 = new AlquilerBicicleta(503, 'Óscar Gil', 3, EstadoAlquiler::Finalizado);
$alquiler4 = new AlquilerPatinete(504, 'Lucía Molina', 1, EstadoAlquiler::Reservado);

$alquileres = [$alquiler1, $alquiler2, $alquiler3, $alquiler4];

$servicio = new ServicioAlquileres($alquileres); 

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

mostrar('Colección inicial', $alquileres, $servicio);
mostrar('Sin filtros', $servicio->consultar(), $servicio);
mostrar('Texto LUCÍA', $servicio->consultar(' LUCÍA '), $servicio);
mostrar('Estado activo', $servicio->consultar('', EstadoAlquiler::Activo), $servicio);
mostrar('Texto MOLINA y estado reservado', $servicio->consultar('MOLINA', EstadoAlquiler::Reservado), $servicio);
mostrar('Texto ÓSCAR y estado reservado', $servicio->consultar('ÓSCAR', EstadoAlquiler::Reservado), $servicio);

// 4.3 Modificaciones 

// Definimos una funcion auxiliar para no repetir codigo
function intentarOperacion(
        Alquiler $alquiler,
        string $operacion
    ): void {
        echo 'Operación: ' . $operacion
            . ' | Alquiler: ' . $alquiler->id()
            . PHP_EOL;

        try {
            if ($operacion === 'iniciar') {
                $alquiler->iniciar();
            } else {
                $alquiler->finalizar();
            }
        } catch (AlquilerException $e) {
            echo 'Rechazo: ' . $e->getMessage() . PHP_EOL;
        }

        echo 'Estado: ' . $alquiler->estado()->value
            . PHP_EOL . PHP_EOL;
}


// Operaciones 
foreach ($alquileres as $alquiler) {
    if ($alquiler->id() === 501) {
        intentarOperacion($alquiler, 'iniciar');
        break;
    }
}

foreach ($alquileres as $alquiler) {
    if ($alquiler->id() === 501) {
        intentarOperacion($alquiler, 'iniciar');
        break;
    }
}

foreach ($alquileres as $alquiler) {
    if ($alquiler->id() === 501) {
        intentarOperacion($alquiler, 'finalizar');
        break;
    }
}

foreach ($alquileres as $alquiler) {
    if ($alquiler->id() === 503) {
        intentarOperacion($alquiler, 'iniciar');
        break;
    }
}

foreach ($alquileres as $alquiler) {
    if ($alquiler->id() === 504) {
        intentarOperacion($alquiler, 'finalizar');
        break;
    }
}

foreach ($alquileres as $alquiler) {
    if ($alquiler->id() === 502) {
        intentarOperacion($alquiler, 'finalizar');
        break;
    }
}

foreach ($alquileres as $alquiler) {
    if ($alquiler->id() === 504) {
        intentarOperacion($alquiler, 'iniciar');
        break;
    }
}


// PENDIENTE DE TERMINAR. 4.3 PENDIENTE