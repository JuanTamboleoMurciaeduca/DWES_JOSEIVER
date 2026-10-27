<?php
declare(strict_types=1);

trait GeneraEtiqueta
{
    public function etiqueta(string $prefijo = ''): string
    {
        $nombreLimpio = preg_replace('/\s+/u', ' ', trim($this->nombre())) ?? '';
        return $prefijo . $this->id() . ' · ' . $nombreLimpio;
    }
}
