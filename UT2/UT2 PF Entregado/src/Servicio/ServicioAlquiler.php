<?php

use Clase\Alquileres\Modelo\Alquiler;
use Clase\Alquileres\Modelo\EstadoAlquiler;

class ServicioAlquiler
{

    public function __construct(private array $alquileres) {}

    public function todos(): array
    {
        return $this->alquileres;
    }

    // 3.2 Filtrar y ordenar (2,00 puntos)

    public function consultar(string $texto = '', ?EstadoAlquiler $estado = null): array
    {
        $textoNormalizado = $this->normalizar($texto);

        $coincidencias = array_filter(
            $this->alquileres,
            fn(Alquiler $alquiler): bool =>
            str_contains($this->normalizar($alquiler->cliente()), $textoNormalizado) &&
                ($estado === null || $estado === $alquiler->estado())
        );

        usort(
            $coincidencias,
            fn(Alquiler $a, Alquiler $b): int => ($a->importe() <=> $b->importe()) === 0
                ? $a->id() <=> $b->id()
                : $a->importe() <=> $b->importe()
        );

        return $coincidencias;
    }

    private function normalizar(string $texto): string
    {
        return mb_strtolower(trim($texto), 'UTF-8');
    }

    public function resumir(array $alquileres): array
    {
        return array_reduce(
            $alquileres,
            fn(array $carry, Alquiler $item): array => [
                'cantidad' => $carry['cantidad'] + 1,
                'importe' => $carry['importe'] + $item->importe()
            ],
            ['cantidad' => 0, 'importe' => 0]
        );
    }
}
