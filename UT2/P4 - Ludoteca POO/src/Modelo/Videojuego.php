<?php
declare(strict_types=1);

// TODO M6. Especializa Videojuego con su constructor, plazo y ficha.
class Videojuego extends Juego {
    private string $plataforma;

    // #[Override]
    public function __construct(int $id, string $nombre, string $plataforma){
        parent::__construct($id, $nombre);

        $plataformaLimpia = trim($plataforma);

        if($plataformaLimpia === '') {
            throw new InvalidArgumentException('La plataforma no puede ser un texto vacío');
        }

        $this->plataforma = $plataformaLimpia;
    }

    public function plataforma(): string {
        return $this->plataforma;
    }

    // #[Override]
    public function plazoMaximo(): int {
        return 7;
    }

    // #[Override]
    public function ficha(): string
    {
        return parent::ficha() . ' · Plataforma: ' . $this->plataforma;
    }
}