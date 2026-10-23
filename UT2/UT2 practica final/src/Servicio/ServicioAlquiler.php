<?php

use Clase\Alquileres\Modelo\Alquiler;
use Clase\Alquileres\Modelo\EstadoAlquiler;

class ServicioAlquiler{

    public function __construct(private array $alquileres)
    {

    }

    public function todos(): array {
        return $this->alquileres;
    }

    // 3.2 Filtrar y ordenar (2,00 puntos)

    public function consultar(string $texto='', ?EstadoAlquiler $estado = null): void {
        $textoNormalizado = $this->normalizar($texto);
        
        $coincidencias = array_filter(
            $alquileres,
            fn($alquiler):array => {
                $this->normalizar($alquiler->cliente())
            }    sdg,.nbsdalkja
        )
    
    }

    private function normalizar(string $texto): string {
        return mb_strtolower(trim($texto), 'UTF-8');    
    }

    public function resumir(array $alquileres): array {
        $resumen = 
    }
}