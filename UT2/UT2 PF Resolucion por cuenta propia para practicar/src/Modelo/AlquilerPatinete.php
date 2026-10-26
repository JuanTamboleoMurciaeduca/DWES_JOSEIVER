<?php
namespace Clase\Alquileres\Modelo;

use Override;

class AlquilerPatinete extends Alquiler {

    #[Override]
    public function modalidad(): string
    {
        return 'patinete';
    }

    #[Override]
    protected function tarifaDiaria(): int
    {
        return 1000;
    }
}