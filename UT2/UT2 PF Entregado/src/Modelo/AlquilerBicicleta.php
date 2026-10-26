<?php

namespace Clase\Alquileres\Modelo;

use Override;

abstract class AlquilerBicicleta extends Alquiler{
    
    #[Override]
    public function modalidad(): string
    {
        return 'bicicleta';
    }

    #[Override]
    public function tarifaDiaria(): int
    {
        return 500;
    }
}