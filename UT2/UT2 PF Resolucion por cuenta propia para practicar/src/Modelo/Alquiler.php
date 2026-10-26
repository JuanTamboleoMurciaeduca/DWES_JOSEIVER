<?php

namespace Clase\Alquileres\Modelo;

use Clase\Alquileres\Excepcion\AlquilerException;
use InvalidArgumentException;

abstract class Alquiler
{

    public function __construct(
        private readonly int $id,
        private string $cliente,
        private int $dias,
        private EstadoAlquiler $estado
    ) {
        $this->cliente = trim($this->cliente);

        if ($this->id < 1) {
            throw new InvalidArgumentException('El id debe ser un numero positivo');
        }

        if ($this->cliente === '') {
            throw new InvalidArgumentException('El cliente no puede estar vacio');
        }

        if ($this->dias < 1 || $this->dias > 7) {
            throw new InvalidArgumentException('Los dias deben estar entre 1-7 dias');
        }
    }

    public function id(): int
    {
        return $this->id;
    }

    public function cliente(): string
    {
        return $this->cliente;
    }

    public function dias(): int
    {
        return $this->dias;
    }

    public function estado(): EstadoAlquiler
    {
        return $this->estado;
    }

    public abstract function modalidad(): string;
    
    protected abstract function tarifaDiaria(): int;

    public function importe(): int {
        return $this->dias() * $this->tarifaDiaria();
    }

    public function iniciar(): void {
        if ($this->estado() !== EstadoAlquiler::Reservado){
            throw new AlquilerException('Solo se puede iniciar un alquiler en estado reservado');
        }
        $this->estado = EstadoAlquiler::Activo;
    }

    public function finalizar(): void {
        if ($this->estado() !== EstadoAlquiler::Activo){
            throw new AlquilerException('Solo se puede finalizar un alquiler en estado activo');
        }
        $this->estado = EstadoAlquiler::Finalizado;
    }
    
}
