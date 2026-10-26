<?php
declare(strict_types=1);

namespace App\Repositorio;

use App\Contrato\RepositorioEnvios;
use App\Excepcion\EnvioException;
use App\Modelo\Envio;
use InvalidArgumentException;
use Override;

class RepositorioEnviosMemoria implements RepositorioEnvios {

    private array $envios = [];

    #[Override]
    public function registrar(Envio $envio): void {
        foreach ($this->envios as $existente) {
            if ($existente->id() === $envio->id()) {
                throw new EnvioException("Ya existe un envio con el id {$envio->id()}");
            }
        }
        $this->envios[] = $envio;
    }

    #[Override]
    public function todos(): array {
        return array_values($this->envios);
    }

    #[Override]
    public function buscar(int $id): ?Envio {
        if ($id <= 0) {
            throw new InvalidArgumentException("El id tiene que ser positivo");
        }

        foreach ($this->envios as $envio) {
            if ($envio->id() === $id) {
                return $envio;
            }
        }

        return null;
    }
}
