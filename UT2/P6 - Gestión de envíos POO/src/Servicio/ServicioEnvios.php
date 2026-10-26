<?php
declare(strict_types=1);

namespace App\Servicio;

use App\Contrato\RepositorioEnvios;
use App\Excepcion\EnvioException;
use App\Modelo\Envio;
use App\Modelo\EstadoEnvio;
use InvalidArgumentException;

class ServicioEnvios {

    public function __construct(private RepositorioEnvios $repositorio) {}

    private function obtener(int $id): Envio {
        if ($id <= 0) {
            throw new InvalidArgumentException("El id tiene que ser positivo");
        }

        $envio = $this->repositorio->buscar($id);
        if ($envio === null) {
            throw new EnvioException("No existe el envio con id {$id}");
        }

        return $envio;
    }

    public function enviar(int $id): void {
        $this->obtener($id)->enviar();
    }

    public function entregar(int $id): void {
        $this->obtener($id)->entregar();
    }

    public function cancelar(int $id): void {
        $this->obtener($id)->cancelar();
    }

    private static function normalizar(string $texto): string {
        $textoLimpio = trim($texto);
        return $textoLimpio === '' ? '' : mb_strtolower((string) preg_replace('/\s+/u', ' ', $textoLimpio), 'UTF-8');
    }

    public function consultar(
        string $texto = '',
        ?string $modalidad = null,
        ?EstadoEnvio $estado = null,
        string $orden = 'precio'
    ): array {
        if ($modalidad !== null && $modalidad !== 'normal' && $modalidad !== 'urgente') {
            throw new InvalidArgumentException("Modalidad no valida");
        }

        if ($orden !== 'precio' && $orden !== 'peso') {
            throw new InvalidArgumentException("Orden no valido");
        }

        $textoNormalizado = self::normalizar($texto);
        $filtrados = [];

        foreach ($this->repositorio->todos() as $envio) {
            if ($textoNormalizado !== '' && !str_contains(self::normalizar($envio->cliente()), $textoNormalizado)) {
                continue;
            }

            if ($modalidad !== null && $envio->modalidad() !== $modalidad) {
                continue;
            }

            if ($estado !== null && $envio->estado() !== $estado) {
                continue;
            }

            $filtrados[] = $envio;
        }

        usort($filtrados, function (Envio $a, Envio $b) use ($orden): int {
            $comparacion = ($orden === 'precio')
                ? ($a->tarifa() <=> $b->tarifa())
                : ($a->peso() <=> $b->peso());

            return ($comparacion !== 0) ? $comparacion : ($a->id() <=> $b->id());
        });

        return array_values($filtrados);
    }

    public function etiquetas(array $envios): array {
        return array_map(
            fn(Envio $e): string => "{$e->id()} | {$e->cliente()} | {$e->modalidad()} | {$e->estado()->value} | {$e->tarifa()} céntimos",
            $envios
        );
    }

    public function resumir(array $envios): array {
        $resumen = [
            'cantidad' => 0,
            'peso' => 0,
            'importeTotal' => 0,
            'importeActivo' => 0,
            'pendiente' => 0,
            'enviado' => 0,
            'entregado' => 0,
            'cancelado' => 0,
        ];

        foreach ($envios as $envio) {
            $resumen['cantidad']++;
            $resumen['peso'] += $envio->peso();
            $resumen['importeTotal'] += $envio->tarifa();

            if ($envio->estado() !== EstadoEnvio::Cancelado) {
                $resumen['importeActivo'] += $envio->tarifa();
            }

            match ($envio->estado()) {
                EstadoEnvio::Pendiente => $resumen['pendiente']++,
                EstadoEnvio::Enviado => $resumen['enviado']++,
                EstadoEnvio::Entregado => $resumen['entregado']++,
                EstadoEnvio::Cancelado => $resumen['cancelado']++,
            };
        }

        return $resumen;
    }
}
