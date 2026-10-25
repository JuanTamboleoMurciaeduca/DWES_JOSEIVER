<?php
declare(strict_types=1);

// TODO M3. Declara el trait GeneraEtiqueta y su método etiqueta.
trait GeneraEtiqueta{
    public function etiqueta(string $prefijo =''): string {
        $nombrelimpio = preg_replace('/\s+/', ' ', ($this->nombre()));

        return $prefijo . $this->id() . ' · ' . $this->nombre();
    }
}
