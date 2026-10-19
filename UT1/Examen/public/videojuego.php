<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/datos.php';
require_once __DIR__ . '/../src/funciones.php';

$id = $_GET['id'] ?? 0;
$id = (int) $id; 

$videojuego = buscarPorId($videojuegos, $id);

// Completa el tratamiento del caso en el que el videojuego no existe.
if ($videojuego === null) {
    ?>
    <!doctype html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Videojuego no encontrado</title>
    </head>
    <body>
        <h1>Videojuego no encontrado</h1>

        <p>No existe ningún videojuego con el id <?= $id ?>.</p>

        <p><a href="index.php">Volver al catálogo</a></p>
    </body>
    </html>

    <?php
    exit;
}
?>


<?php
//Prepara las fechas y los valores que necesita la ficha 
$fechaLanzamiento = new DateTimeImmutable($videojuego['fechaLanzamiento']);// De dónde saco la fecha??
$hoy = new DateTimeImmutable('today');
$diasTranscurridos = $fechaLanzamiento->diff($hoy)->days; //0? Habrá que calcular algo, no?
$finNovedad = $fechaLanzamiento->modify('+30 days');

if($hoy >= $finNovedad) {
    $estado = 'catalogo';
}else {
    $estado = 'novedad';
}
// COMPLETAR los cálculos anteriores utilizando los datos del videojuego.
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ficha del videojuego</title>
</head>
<body>
    <h1><?= htmlspecialchars($videojuego['titulo'] ?? '') ?></h1>

    <dl>
        <dt>Estudio</dt>
        <dd><?= htmlspecialchars($videojuego['estudio'] ?? '') ?></dd>

        <dt>Género</dt>
        <dd><?= htmlspecialchars($videojuego['genero'] ?? '') ?></dd>

        <dt>Plataforma</dt>
        <dd><?= htmlspecialchars($videojuego['plataforma'] ?? '') ?></dd>

        <dt>Precio</dt>
        <dd>
            <?php if ($videojuego !== null): ?>
                <?= number_format($videojuego['precio'], 2, ',', '.') ?> €
            <?php endif; ?>
        </dd>

        <dt>Puntuación</dt>
        <dd><?= $videojuego['puntuacion'] ?? '' ?></dd>

        <dt>Fecha de lanzamiento</dt>
        <dd><?= $fechaLanzamiento->format('d/m/Y') ?><!-- COMPLETAR --></dd>

        <dt>Días desde el lanzamiento</dt>
        <dd><?= $diasTranscurridos ?><!-- COMPLETAR --></dd>

        <dt>Fin del periodo de novedad</dt>
        <dd><?= $finNovedad->format('d/m/Y') ?><!-- COMPLETAR --></dd>

        <dt>Estado</dt>
        <dd><?= $estado ?></dd>
    </dl>

    <p><a href="index.php">Volver al catálogo</a></p>
</body>
</html>
