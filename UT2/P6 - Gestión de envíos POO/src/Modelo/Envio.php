<?php
declare(strict_types=1);

namespace App\Modelo;

use App\Excepcion\EnvioException;
use App\Modelo\EstadoEnvio;
use InvalidArgumentException;

abstract class Envio {

    public function __construct(
        private readonly int $id,
        private string $cliente,
        private int $peso,
        private EstadoEnvio $estado
    )
    {
        $this->cliente = trim($this->cliente);

        if ($this->id < 1) {
            throw new InvalidArgumentException('El id debe ser positivo');
        }
        if ($this->cliente === '') {
            throw new InvalidArgumentException('El cliente no puede estar vacio');
        }
        if ($this->peso < 1 || $this->peso > 20000) {
            throw new InvalidArgumentException('El peso tiene que estar entre 1 y 20000');
        }
    }

    public function id(): int {
        return $this->id;
    }

    public function cliente(): string {
        return $this->cliente;
    }

    public function peso(): int {
        return $this->peso;
    }

    public function estado(): EstadoEnvio {
        return $this->estado;
    }

    public function tarifa(): int {
        $bloques = (int) ceil($this->peso() / 1000);
        return $this->cuotaFija() + $bloques * $this->precioBloque();
    }

    abstract public function modalidad(): string;

    abstract protected function cuotaFija(): int;

    abstract protected function precioBloque(): int;

    public function enviar(): void {
        $this->cambiarEstado(EstadoEnvio::Pendiente, EstadoEnvio::Enviado);
    }

    public function entregar(): void {
        $this->cambiarEstado(EstadoEnvio::Enviado, EstadoEnvio::Entregado);
    }

    public function cancelar(): void {
        $this->cambiarEstado(EstadoEnvio::Pendiente, EstadoEnvio::Cancelado);
    }

    private function cambiarEstado(EstadoEnvio $origen, EstadoEnvio $destino): void {
        if ($this->estado !== $origen) {
            throw new EnvioException("No se puede pasar de {$this->estado->value} a {$destino->value}");
        }
        $this->estado = $destino;
    }
}
