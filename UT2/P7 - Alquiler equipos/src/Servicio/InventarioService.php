<?php

declare(strict_types=1);

namespace Alquiler\Equipo\Servicio;

use Alquiler\Equipo\Contrato\EquipoRepository;
use Alquiler\Equipo\Excepcion\EquipoException;
use Alquiler\Equipo\Modelo\{Equipo, EstadoEquipo};

final class InventarioService
{
    public function __construct(private EquipoRepository $repository)
    {
    }

    public function filtrar(
        string $texto = '',
        ?EstadoEquipo $estado = null,
        int $minDisponibles = 0
    ): array {
        $texto = mb_strtolower(trim($texto), 'UTF-8');

        if ($minDisponibles < 0) {
            throw new \InvalidArgumentException('Mínimo negativo');
        }

        // TODO F1: filtra con array_filter y devuelve claves consecutivas.
        $resultado = array_filter(
            $this->repository->todos(),
            fn (Equipo $equipo): bool => 
                (str_contains($equipo->nombreNormalizado(), $texto))
                &&
                ($estado === null || $estado === $equipo->estado())
                &&
                (($equipo->estado() === EstadoEquipo::Disponible && $equipo->disponibles() >= $minDisponibles)
                ||
                $minDisponibles === 0
                )
        );
        return array_values($resultado);
    }

    public function ordenar(array $equipos): array
    {
        // TODO F2: ordena una copia mediante usort y un callback.
        $ordenados =$equipos;
        
        usort(
            $ordenados,
            function(Equipo $a, Equipo $b): int {
                $porDisponibles = $b->disponibles() <=> $a->disponibles();
                if($porDisponibles !== 0) {
                    return $porDisponibles;
                }

                $porTarifa = $a->tarifaDia() <=> $b->tarifaDia();
                if ($porTarifa !== 0){
                    return $porTarifa;
                }
                
                $porId = $a->id() <=> $b->id();
                if ($porId !== 0) {
                    return $porId;
                }
                return $porId;
            }
        );
        return $ordenados;
    }

    public function fichas(array $equipos, string $prefijo = 'Equipo: '): array
    {
        // TODO F3: utiliza array_map y una arrow function.
        $fichas = array_map(
            fn (Equipo $equipo):string => $equipo->ficha($prefijo),
            $equipos
        );

        return $fichas;
    }

    public function resumen(array $equipos): array
    {
        // TODO F4: acumula las tres cifras mediante array_reduce.
        $unidades = array_reduce(
            $equipos,
            fn(int $acumulador, Equipo $equipo) => $acumulador + $equipo->unidades()
            , 0
        );

        $reservadas = array_reduce($equipos,
            fn(int $acumulador, Equipo $equipo) => $acumulador + $equipo->reservadas()
            , 0
        );

        $valorDisponibleCentimos = array_reduce(
            $equipos,
            fn(int $acumulador, Equipo $equipo) => $acumulador + ($equipo->disponibles() * $equipo->tarifaDia())
            , 0  
        );

        $resumen = [
            'unidades' => $unidades,
            'reservadas' => $reservadas,
            'valorDisponibleCentimos' => $valorDisponibleCentimos
        ];

        return $resumen;
    
    }

    public function presupuestarLotes(
        int $cantidad,
        int $dias,
        int $presupuestoCentimos
    ): array {
        // TODO D1: repara las etapas conservando las funciones de arrays.
        if ($cantidad <= 0 || $dias <= 0 || $presupuestoCentimos < 0) {
            throw new \InvalidArgumentException('Cantidad, días o presupuesto no válidos');
        }

        $candidatos = array_filter(
            $this->repository->todos(),
            fn (Equipo $equipo): bool =>
                $equipo->estado() === EstadoEquipo::Disponible
                && $equipo->disponibles() >= $cantidad
        );

        $propuestas = array_map(
            fn (Equipo $equipo): array => [
                'id' => $equipo->id(),
                'importeCentimos' => $equipo->tarifaDia() * $dias * $cantidad,
                'disponiblesDespues' => $equipo->disponibles() - $cantidad
            ],
            $candidatos
        );

        $opciones = array_reduce(
            $propuestas,
            function (array $resultado, array $propuesta) use ($presupuestoCentimos): array {
                if ($propuesta['importeCentimos'] <= $presupuestoCentimos) {
                    $resultado[] = $propuesta;
                }

                return $resultado;
            },
            []
        );

        usort(
            $opciones,
            fn (array $a, array $b): int =>
                (($a['importeCentimos'] <=> $b['importeCentimos']) !== 0)
                    ? ($a['importeCentimos'] <=> $b['importeCentimos'])
                    : ($a['id'] <=> $b['id'])
        );

        return $opciones;
    }

    private function requerido(int $id): Equipo
    {
        return $this->repository->buscarPorId($id)
            ?? throw new EquipoException('El equipo no existe');
    }

    public function reservar(int $id, int $cantidad): void
    {
        $this->requerido($id)->reservar($cantidad);
    }

    public function devolver(int $id, int $cantidad): void
    {
        $this->requerido($id)->devolver($cantidad);
    }
}
