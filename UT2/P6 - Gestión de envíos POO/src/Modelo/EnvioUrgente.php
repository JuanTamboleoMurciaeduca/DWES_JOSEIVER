<?php
declare(strict_types=1);

namespace App\Modelo;

use Override;

class EnvioUrgente extends Envio {

    #[Override]
    public function modalidad(): string
    {
        return 'urgente';
    }

    #[Override]
    public function precioBloque(): int
    {
        return 200;
    }

    #[Override]
    public function cuotaFija(): int
    {
        return 600;
    }

}