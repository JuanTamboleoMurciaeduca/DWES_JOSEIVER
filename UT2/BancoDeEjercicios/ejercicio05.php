<?php

declare(strict_types=1);

// Ejercicio 5. array_map
// Obtén un nuevo array con textos del tipo "Dune - 412 páginas" a partir de un catálogo. La 
// transformación debe realizarse con array_map.

$catalogo = [
    ['titulo' => 'Dune', 'paginas' => 412],
    ['titulo' => 'Solaris', 'paginas' => 216],
    ['titulo' => '1984', 'paginas' => 328],
    ['titulo' => 'Drácula', 'paginas' => 418],
];

$textos = array_map(
    fn (array $libro): string => "{$libro['titulo']} - {$libro['paginas']} páginas",
    $catalogo
);

echo "Catálogo formateado con array_map:" . PHP_EOL;
print_r($textos);
