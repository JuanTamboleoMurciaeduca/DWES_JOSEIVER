<?php
declare(strict_types=1);

// TODO M3. Implementa el trait GeneraEtiqueta usando id() y nombre().
trait GenerarEtiqueta{
    public function etiqueta(): string{
        return id() . ' · ' . nombre();
    }
}