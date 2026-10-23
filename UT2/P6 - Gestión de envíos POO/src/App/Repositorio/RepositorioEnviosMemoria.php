<?php

namespace App\Repositorio;

use App\Contrato\RepositorioEnvios;
use App\Excepcion\EnvioException;
use App\Modelo\Envio;
use Override;

class RepositorioEnviosMemoria implements RepositorioEnvios {
    private array $envios = [];

    #[Override]
    public function registrar(Envio $envio): void
    {
        $coincidencias = array_filter(
            $this->envios,
            fn($existente) => $existente->id() === $envio->id()
            );

        if (!empty($coincidencias)) {
            throw new EnvioException('Ya existe un envio con ese id');
        }
        $this->envios[] = $envio;
    }

    #[Override]
    public function todos(): array
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function buscar(int $id): ?Envio
    {
        throw new \Exception('Not implemented');
    }
}