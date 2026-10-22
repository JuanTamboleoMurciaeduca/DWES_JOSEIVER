<?php
namespace App\Modelo;

use InvalidArgumentException;

abstract class Envio {
    public function __construct(
        private readonly int $id,
        private string $cliente,
        private int $peso,
        private EstadoEnvio $estado
    ){
        $this->cliente = trim($cliente);
        
        if($id < 1) {
            throw new InvalidArgumentException('El id debe ser un numero positivo');
        }
        if($this->cliente === '') {
            throw new InvalidArgumentException('El campo cliente no puede estar vacio');
        }

        if($peso < 1 || $peso > 20000){
            throw new InvalidArgumentException('El peso debe estar entre 1g - 20000g');
        }
    }

    public function id(): int {return $this->id;}

    public function cliente(): string {return $this->cliente;}

    public function peso(): int {return $this->peso;}

    public function estado(): EstadoEnvio {return $this->estado;}

}