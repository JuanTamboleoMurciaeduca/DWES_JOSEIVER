<?php

namespace Clase\Alquileres\Modelo;

use InvalidArgumentException;
use Clase\Alquileres\Excepcion\AlquilerException;

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
            throw new InvalidArgumentException('El nombre del cliente no puede quedar vacío');
        }

        if ($this->dias < 1 || $this->dias > 7) {
            throw new InvalidArgumentException('La duración debe estar entre 1-7  días');
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

    //2.2 Importe del alquiler (1,00 puntos)

    public abstract function modalidad(): string;

    protected abstract function tarifaDiaria(): int;


    // calcular el importe a partir de los días contratados y la tarifa diaria de la modalidad.
    public function importe(): int
    {
        return $this->dias * $this->tarifaDiaria();
    }

    // 2.3 Inicio y finalización (1,25 puntos)
    public function iniciar(): void
    {
        if ($this->estado !== EstadoAlquiler::Reservado) {
            throw new AlquilerException('No se puede iniciar un alquiler que no ha sido reservado');
        }
        $this->estado = EstadoAlquiler::Activo;
    }

    public function finalizar(): void
    {
        // Si te metes a value es string, no puedes comparar string con EstadoAlquiler
        if ($this->estado !== EstadoAlquiler::Activo) {
            throw new AlquilerException('No se puede finalizar un alquiler que no ha sido iniciado');
        }
        $this->estado = EstadoAlquiler::Finalizado;
    }
}
