<?php

namespace App\Modelo;

use App\Excepcion\EnvioException;
use InvalidArgumentException;

abstract class Envio
{
    public function __construct(
        private readonly int $id,
        private string $cliente,
        private int $peso,
        private EstadoEnvio $estado
    ) {
        $this->cliente = trim($cliente);

        if ($id < 1) {
            throw new InvalidArgumentException('El id debe ser un numero positivo');
        }
        if ($this->cliente === '') {
            throw new InvalidArgumentException('El campo cliente no puede estar vacio');
        }

        if ($peso < 1 || $peso > 20000) {
            throw new InvalidArgumentException('El peso debe estar entre 1g - 20000g');
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

    public function peso(): int
    {
        return $this->peso;
    }

    public function estado(): EstadoEnvio
    {
        return $this->estado;
    }

    public function tarifa(): int
    {
        $bloques = ceil($this->peso / 1000);
        $precioBloque = $this->precioBloque();
        $cuotaFija = $this->cuotaFija();

        return $cuotaFija + ($bloques * $precioBloque);
    }

    public abstract function modalidad(): string;

    protected abstract function cuotaFija(): int;

    protected abstract function precioBloque(): int;

    public function enviar(): void {
        $this->cambiarEstado(EstadoEnvio::Pendiente, EstadoEnvio::Enviado);
    }

    public function entregar(): void {
        $this->cambiarEstado(EstadoEnvio::Enviado, EstadoEnvio::Entregado);
    }

    public function cancelar(): void {
        $this->cambiarEstado(EstadoEnvio::Pendiente, EstadoEnvio::Cancelado);
    }

    private function cambiarEstado(EstadoEnvio $estadoEsperado, EstadoEnvio $nuevoEstado): void {
        
        if ($this->estado !== $estadoEsperado) {
            throw new EnvioException(
                "No se puede cambiar el estado: el envío está en 
                '{$this->estado->value}' y se esperaba '{$estadoEsperado->value}'."
            );
        }
        $this->estado = $nuevoEstado;
    }
}
