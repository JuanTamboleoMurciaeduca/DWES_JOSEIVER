<?php
declare(strict_types=1);

namespace App\Modelo;

use Override;

class EnvioNormal extends Envio{

    #[Override]
    public function modalidad(): string
    {
        return 'normal';
    }

    #[Override]
    public function precioBloque(): int
    {
        return 120;
    }

    #[Override]
    public function cuotaFija(): int
    {
        return 350;
    }
}