<?php
declare(strict_types=1);

// TODO M5. Especializa JuegoMesa con su constructor, plazo y ficha.
class JuegoMesa extends Juego {
    private int $jugadores;

    // #[Override]
    public function __construct(int $id, string $nombre, int $jugadores){
        
        parent::__construct($id, $nombre);
        
        if ($jugadores < 1) {
            throw new InvalidArgumentException('El numero de jugadores debe ser mayor que cero');
        }

        $this->jugadores = $jugadores;
    }

    public function jugadores(): int {
        return $this->jugadores;
    }

    // #[Override]
    public function plazoMaximo(): int {
        return 14;
    }

    // #[Override]
    public function ficha(): string{
        return parent::ficha() . ' · Jugadores: ' . $this->jugadores;
    }

    
}
