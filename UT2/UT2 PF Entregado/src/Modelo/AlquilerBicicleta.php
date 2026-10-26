<?php

namespace Clase\Alquileres\Modelo;

// No son abstractas
class AlquilerBicicleta extends Alquiler
{
    public function modalidad(): string
    {
        return 'bicicleta';
    }

    protected function tarifaDiaria(): int
    {
        return 500;
    }
}
