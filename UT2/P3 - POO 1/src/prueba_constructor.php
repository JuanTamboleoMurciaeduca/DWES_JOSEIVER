<?php
declare(strict_types=1);

require_once __DIR__ . '/Autor.php';
require_once __DIR__ . '/Categoria.php';
require_once __DIR__ . '/Libro.php';

// Fase 2.1: crea aquí un Autor y una Categoria y muestra sus nombres.
$autor = new Autor('Frank Herbert');
$categoria = new Categoria('Ciencia Ficción');

echo $autor->nombre;
echo $categoria->nombre;
// Fase 2.2: cuando completes Libro.php, añade su require_once arriba.
// Después crea los dos libros y muestra su disponibilidad.
$libro = new Libro(1, 'Dune', 412, $autor, $categoria);

$libro->disponible;

$libro2 = new Libro(1, 'Dune', 412, $autor, $categoria, false);
$libro2->disponible;


// Fase 3.2: sustituye las pruebas anteriores por un Libro construido
// con las variables $titulo y $paginas. Muestra ambas propiedades.
$titulo = ' Dune ';
$paginas = 412;

$libroCompleto = new Libro(1, $titulo, $paginas, $autor, $categoria);
echo $libroCompleto->titulo;
echo $libroCompleto->paginas;
