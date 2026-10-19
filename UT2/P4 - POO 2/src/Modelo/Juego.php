<?php
declare(strict_types=1);

// TODO M4. Implementa la base abstracta Juego y las operaciones del préstamo.
abstract class Juego implements Prestable{

    use GeneraEtiqueta;


    private int $id;
    private string $nombre;
    private bool $prestado = false;
    private int $dias = 0;

    public function __construct(int $id, string $nombre){

        $nombreLimpio = trim($nombre);

        $id > 0 ? $this->id = $id : throw new InvalidArgumentException("El ID debe ser positivo");
        $nombreLimpio !== '' ? $this->nombre = $nombreLimpio : throw new InvalidArgumentException("El nombre no puede estar vacío"); 
    }

    public function id(): int{
        return $this->id;
    }

    public function nombre(): string {
        return $this->nombre;
    }

    public function prestado(): bool {
        return $this->prestado;
    }

    public function dias(): int {
        return $this->dias;
    }

    public abstract function plazoMaximo(): int;

    public function ficha(): string {
        return $this->etiqueta() . ' · '
            .($this->prestado === true ? 'Prestado' : 'Disponible')
            . ' · Días: ' . $this->dias;
    }

    public function prestar(int $dias): void {
        if ($dias < 1) {
            throw new InvalidArgumentException('Los dias deben ser mayor que cero');
        }
        if ($this->prestado) {
            throw new PrestamoException('El juego ya está prestado');
        }
        if ($dias > $this->plazoMaximo()) {
            throw new PrestamoException('Se supera el plazo máximo');
        }

        $this->prestado = true;
        $this->dias = $dias;
    }
}
