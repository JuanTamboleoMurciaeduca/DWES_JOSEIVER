<?php

namespace App\Modelo;

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
            throw new \InvalidArgumentException('El identificador debe ser positivo');
        }
    }

    public function id(): int {return $this->id;}

    public function cliente(): string {return $this->cliente;}

    public function peso():int {return $this->peso;}

    public function estado(): EstadoEnvio {return $this->estado;}
}