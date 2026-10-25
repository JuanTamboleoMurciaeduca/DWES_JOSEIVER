<?php
declare(strict_types=1);

// TODO M6. Implementa la clase abstracta Actividad, sus reglas y las operaciones final.

abstract class Actividad implements Reservable
{
    use GeneraEtiqueta;

    public function __construct(
        private readonly int $id,
        private readonly string $nombre,
        private readonly int $capacidad,
        private int $ocupadas,
        private readonly EstadoActividad $estado,
        private readonly ?Responsable $responsable
    ) {
        if ($id <= 0) {
            throw new InvalidArgumentException('El identificador debe ser positivo.');
        }
        if (trim($nombre) === '') {
            throw new InvalidArgumentException('El nombre no puede estar vacío.');
        }
        if ($capacidad <= 0) {
            throw new InvalidArgumentException('La capacidad debe ser mayor que cero.');
        }
        if ($ocupadas < 0 || $ocupadas > $capacidad) {
            throw new InvalidArgumentException('Las plazas ocupadas deben estar entre 0 y la capacidad.');
        }
    }

    public function id(): int
    {
        return $this->id;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function capacidad(): int
    {
        return $this->capacidad;
    }

    public function ocupadas(): int
    {
        return $this->ocupadas;
    }

    public function estado(): EstadoActividad
    {
        return $this->estado;
    }

    public function responsable(): ?Responsable
    {
        return $this->responsable;
    }

    public function plazasLibres(): int
    {
        return $this->capacidad - $this->ocupadas;
    }

    abstract public function tipo(): string;

    abstract public function importe(int $cantidad): int;

    final public function reservar(int $cantidad): void
    {
        if ($cantidad <= 0) {
            throw new InvalidArgumentException('Indica un entero positivo.');
        }
        if ($this->estado === EstadoActividad::Cerrada) {
            throw new ReservaException('La actividad está cerrada.');
        }
        if ($cantidad > $this->plazasLibres()) {
            throw new PlazasInsuficientesException('No quedan plazas suficientes.');
        }
        $this->ocupadas += $cantidad;
    }

    final public function cancelar(int $cantidad): void
    {
        if ($cantidad <= 0) {
            throw new InvalidArgumentException('Indica un entero positivo.');
        }
        if ($cantidad > $this->ocupadas) {
            throw new ReservaException('No puedes cancelar más plazas de las ocupadas.');
        }
        $this->ocupadas -= $cantidad;
    }
}
