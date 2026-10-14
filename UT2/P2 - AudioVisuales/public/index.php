<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/equipos.php';
require_once __DIR__ . '/../src/inventario.php';

// Función facilitada: escapar la salida HTML.
function e(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function entrada(string $clave, string $defecto = ''): string
{
    // TODO E1: leer $_GET con isset e is_string; devolver el defecto en otro caso.
    return $defecto;
}

$equipos = prepararEquipos($equipos, $prestamos);

// TODO E2: sustituir estos valores provisionales por la lectura de los controles GET.
$texto = '';
$categoria = '';
$soloDisponibles = false;
$orden = 'nombre';
$id = '';
$codigo = '';

$categorias = obtenerCategorias($equipos);
$aviso = '';

// TODO E3: validar orden y categoria; aplicar los valores por defecto y el aviso indicado.

// TODO E4: llamar al filtrado y ordenación; preparar el resumen y las etiquetas del listado.
$visibles = [];
$resumen = resumirEquipos($visibles);
$etiquetas = [];

$seleccionado = null;
$avisoFicha = '';

if ($id !== '') {
    // TODO E5: validar el id con filter_var y FILTER_VALIDATE_INT, mínimo 1.
    $idEntero = false;

    if ($idEntero === false) {
        $avisoFicha = 'Indica un id entero positivo.';
    } else {
        $seleccionado = buscarPorId($equipos, $idEntero);

        if ($seleccionado === null) {
            $avisoFicha = 'No existe el equipo con ese id.';
        }
    }
}

$prestamosFicha = $seleccionado === null ? [] : array_filter(
    $prestamos,
    fn(array $p): bool => $p['equipoId'] === $seleccionado['id']
);

$validacionCodigo = $codigo === '' ? null : codigoValido($codigo);

require __DIR__ . '/../template/vista.php';
