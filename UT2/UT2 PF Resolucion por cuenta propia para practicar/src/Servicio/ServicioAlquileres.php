<?php

namespace Clase\Alquileres\Servicio;

use Clase\Alquileres\Modelo\Alquiler;
use Clase\Alquileres\Modelo\EstadoAlquiler;

class ServicioAlquileres
{
    public function __construct(private array $alquileres) {}

    public function todos(): array
    {
        return $this->alquileres;
    }

    public function consultar(string $texto = '', ?EstadoAlquiler $estado = null): array
    {

        $textoNormalizado = $this->normalizar($texto);

        // En dos filtros
        // $resultadoNombre = array_filter(
        //     $this->alquileres,
        //     fn($alquiler): bool =>
        //         $textoNormalizado === ''
        //             ? true
        //             : str_contains(
        //                 $this->normalizar($alquiler->cliente()),
        //                 $textoNormalizado
        //             )
        // );

        // $resultadoEstado = array_filter(
        //     $resultadoNombre,
        //     fn($alquiler): bool =>
        //         $estado === null
        //             ? true
        //             : $alquiler->estado() === $estado
        // );


        // EN un solo filtro (ambas comdicionenes)
        $resultado = array_filter(
            $this->alquileres,
            fn($alquiler): bool => ($textoNormalizado === ''
                ?  true
                : str_contains(
                    $this->normalizar($alquiler->cliente()),
                    $textoNormalizado
                ))
                &&
                ($estado === null
                    ? true
                    : $alquiler->estado() === $estado)
        );

        usort(
            $resultado,
            function($alquilerA, $alquilerB): int {
                $comparacionImporte = 
                    $alquilerA->importe() <=> $alquilerB->importe();
            
                $desempatePorId = $comparacionImporte !== 0
                    ? $comparacionImporte
                    : $alquilerA->id() <=> $alquilerB->id();
                
                return $desempatePorId;
            }
        );

        return $resultado;
    }

    private function normalizar(string $texto): string
    {
        return mb_strtolower(trim($texto), 'UTF-8');
    }

    public function resumir(array $alquileres): array {
        
        $cantidad = count($alquileres);
    
        $importe = array_reduce(
            $alquileres,
            fn ($acumulador, $alquiler): int => $acumulador + $alquiler->importe()
            , 0
        );

        $resultado = [
            'cantidad' => $cantidad,
            'importe' => $importe
        ];
        return $resultado;
    }
}
