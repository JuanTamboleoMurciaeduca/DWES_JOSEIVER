<?php
    declare(strict_types=1);

    require_once __DIR__ . '\..\src\datos.php';
    require_once __DIR__ . '\..\src\funciones.php';

    $id = $_GET['id'] ?? null;
    
    
    $libro = null;
    
    if ($id !== null) {
        $id = (int) $id;
        $libro = buscarPorId($catalogo, $id);
    }

    if($libro === null){
        echo 'No se ha encontrado un libro asociado a ese id';
    }else {
        foreach ($libro as $clave => $valor) {
            if ($clave === 'disponible') {
                echo $clave . ': ' . ($valor ? 'Disponible' : 'No disponible') . '<br>';
            } else {
                echo $clave . ': ' . $valor . '<br>';
            }
        }

        $hoy = new DateTimeImmutable();
        $fechaAlta = new DateTimeImmutable($libro['fechaAlta']);
        $diasDesdeAlta = (int) $fechaAlta->diff($hoy)->format('%a');
        $fechaDevolucion = null;

        if ($libro['disponible']){
            $fechaDevolucion = $hoy->modify('+15 days');
        }
        
        if ($fechaDevolucion !== null){
            echo 'Fecha de devolucion simulada:' . $fechaDevolucion->format('d/m/Y');
        }
        
        echo "Dias desde el alta: $diasDesdeAlta";
    }
        
?>