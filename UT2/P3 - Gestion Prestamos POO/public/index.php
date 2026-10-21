<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/Autor.php';
require_once __DIR__ . '/../src/Categoria.php';
require_once __DIR__ . '/../src/Libro.php';
require_once __DIR__ . '/../src/datos.php';

// Fase 4: convierte los registros de $datos en objetos Libro.
$libros = [];

foreach ($datos as $registro) {
    $autor = $registro['autor'] === null
        ? null
        : new Autor($registro['autor']);
    $categoria = new Categoria($registro['categoria']);
    $libros[] = new Libro(
        $registro['id'],
        $registro['titulo'],
        $registro['paginas'],
        $autor,
        $categoria,
        $registro['disponible']
    );
}

// Fase 5: realiza aquí las comprobaciones de préstamos e identidad.
// Añade textos a $mensajes; la vista los mostrará debajo del catálogo.
// Termina devolviendo Dune para conservar el estado inicial del catálogo.
$mensajes = [];

$dune = $libros[0];
$otro = $libros[2];

$mensajes[] = 'Dune al inicio: ' . ($dune->disponible ? 'true' : 'false');
$mensajes[] = '1984 al inicio: ' . ($otro->disponible ? 'true' : 'false');

$dune->prestar();

$mensajes[] = 'Dune después de prestar(): ' . ($dune->disponible ? 'true' : 'false');
$mensajes[] = '1984 después de prestar Dune: ' . ($otro->disponible ? 'true' : 'false');

// 5.3.1 Asigna $alias = $dune y llama a prestar() sobre $alias. Consulta disponible a través de $dune.
$alias = $dune;

$alias->prestar();
$mensajes[] = 'Dune después de devolver(): ' . ($dune->disponible ? 'true' : 'false');

$mensajes[] = 'Disponible: ' . ($alias === $dune ? 'true' : 'false');

// 5.3.3. Crea otro Libro con los mismos datos iniciales de Dune
$copia = new Libro(
    $dune->id,
    $dune->titulo,
    $dune->paginas,
    $dune->autor,
    $dune->categoria,
    $dune->disponible
);

$mensajes[] = 'Disponible: ' . ($copia === $dune ? 'true' : 'false');

// 5.4. Termina llamando a devolver() sobre Dune.
$dune->devolver();
$mensajes[] = 'Disponible: ' . ($dune->disponible ? 'true' : 'false');


// Lectura del formulario facilitada. La búsqueda conserva el texto escrito.
$entrada = $_GET['q'] ?? '';
$entradaBusqueda = is_string($entrada) ? $entrada : '';
$soloDisponibles = isset($_GET['disponibles']);
$ordenEntrada = $_GET['orden'] ?? 'paginas';
$orden = is_string($ordenEntrada)
    && in_array($ordenEntrada, ['paginas', 'titulo'], true)
    ? $ordenEntrada : 'paginas';

// Fase 6.1: normaliza la búsqueda y filtra con array_filter.
$busqueda = mb_strtolower(trim($entradaBusqueda), 'UTF-8');
$visibles = $libros;

$visibles = array_filter(
    $libros,
    fn(Libro $libro) =>
    str_contains(mb_strtolower($libro->titulo, 'UTF-8'), $busqueda)
        &&
        (!$soloDisponibles || $libro->disponible)
);

// Fase 6.2: ordena $visibles mediante usort y <=>.
if ($orden === 'paginas') {
    usort(
        $visibles,
        fn($a, $b) =>
        $a->paginas <=> $b->paginas
    );
}

if ($orden === 'titulo') {
    usort(
        $visibles,
        fn($a, $b) =>
        $a->titulo <=> $b->titulo
    );
}


// Fase 6.3: resumen del catálogo completo, antes de filtrar.
// Completa disponibles con array_filter y paginas con array_reduce.

$totalDisponibles = array_filter(
    $libros,
    fn(Libro $libro) =>
    $libro->disponible
);

$resumen = [
    'total' => count($libros),
    'disponibles' => count($totalDisponibles),
    'paginas' => array_reduce(
        $libros,
        fn(int $acumulador, Libro $libro) =>
        $acumulador + $libro->paginas,
        0
    )
];

// Fase 6.3: crea las fichas de los libros visibles con array_map.
$etiquetas = array_map(
    fn(Libro $libro) => $libro->ficha(),
    $visibles
);

// Fase 6.3: busca los ids 30 y 999 con array_find y añade mensajes.
$resultado1 = array_find(
    $libros,
    fn(Libro $libro): bool => $libro->id === 30
);

$resultado2 = array_find(
    $libros,
    fn(Libro $libro): bool => $libro->id === 999
);

if ($resultado1 !== null) {
    $mensajes[] = "Se ha encontrado el libro con ID 30:  " . $resultado1->titulo;
} else {
    $mensajes[] = "No se ha encontrado un título con ID: 30";
}

if ($resultado2 !== null) {
    $mensajes[] = "Se ha encontrado el libro con ID 999:  " . $resultado2->titulo;
} else {
    $mensajes[] = "No se ha encontrado un título con ID: 999";
}
// 6.3.5. Prepara una segunda llamada con un callback que compare $libro->id === 999. Usa ?-> y ?? para
// mostrar Libro no encontrado cuando array_find devuelva null.
$resultado999 = array_find(
    $libros,
    fn(Libro $libro): bool => $libro->id === 999
);

$mensajes[] = 'Buscar id 999: ' . ($resultado999?->titulo ?? 'Libro no encontrado');

require __DIR__ . '/../vista/catalogo.php';
