<?php

namespace Clase\Alquileres\Modelo;

use Override;

abstract class AlquilerPatinete extends Alquiler{
    
    #[Override]
    public function modalidad(): string
    {
        return 'patinete';
    }

    #[Override]
    public function tarifaDiaria(): int
    {
        return 1000;
    }
}