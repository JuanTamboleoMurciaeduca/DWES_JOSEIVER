<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Excepcion\EnvioException;
use App\Modelo\EnvioNormal;
use App\Modelo\EnvioUrgente;
use App\Modelo\EstadoEnvio;
use App\Repositorio\RepositorioEnviosMemoria;
use App\Servicio\ServicioEnvios;

$repositorio = new RepositorioEnviosMemoria();

// 5.1 Datos iniciales
$repositorio->registrar(new EnvioNormal(101, 'Librería Órbita', 1000, EstadoEnvio::Pendiente));
$repositorio->registrar(new EnvioUrgente(102, 'Taller Norte', 1500, EstadoEnvio::Enviado));
$repositorio->registrar(new EnvioNormal(103, 'Café Álamo', 2500, EstadoEnvio::Entregado));
$repositorio->registrar(new EnvioUrgente(104, 'Estudio Prisma', 500, EstadoEnvio::Cancelado));
$repositorio->registrar(new EnvioNormal(105, 'Papelería Sol', 2000, EstadoEnvio::Pendiente));
$repositorio->registrar(new EnvioUrgente(106, 'Órbita Creativa', 1001, EstadoEnvio::Pendiente));

$servicio = new ServicioEnvios($repositorio);

foreach ($servicio->etiquetas($repositorio->todos()) as $etiqueta) {
    echo $etiqueta . PHP_EOL;
}
print_r($servicio->resumir($repositorio->todos()));

// 5.2 Consultas
function mostrarConsulta(ServicioEnvios $servicio, array $envios): void {
    $etiquetas = $servicio->etiquetas($envios);
    echo empty($etiquetas) ? "Sin resultados" . PHP_EOL : implode(PHP_EOL, $etiquetas) . PHP_EOL;
    print_r($servicio->resumir($envios));
}

mostrarConsulta($servicio, $servicio->consultar());
mostrarConsulta($servicio, $servicio->consultar(texto: ' ÓRBITA '));
mostrarConsulta($servicio, $servicio->consultar(modalidad: 'urgente'));
mostrarConsulta($servicio, $servicio->consultar(estado: EstadoEnvio::Pendiente));
mostrarConsulta($servicio, $servicio->consultar(texto: 'ÓRBITA', modalidad: 'urgente', estado: EstadoEnvio::Pendiente));
mostrarConsulta($servicio, $servicio->consultar(texto: ' ÓRBITA CREATIVA '));
mostrarConsulta($servicio, $servicio->consultar(texto: 'xyz'));
mostrarConsulta($servicio, $servicio->consultar(orden: 'peso'));

foreach ($repositorio->todos() as $envio) {
    echo $envio->id() . " ";
}
echo PHP_EOL;
echo ($repositorio->buscar(101) === $repositorio->buscar(101) ? "Misma instancia" : "Distinta instancia") . PHP_EOL;

// 6.1 Operaciones
$operaciones = [
    fn() => $servicio->enviar(101),
    fn() => $servicio->cancelar(101),
    fn() => $servicio->entregar(101),
    fn() => $servicio->enviar(101),
    fn() => $servicio->cancelar(105),
    fn() => $servicio->enviar(105),
    fn() => $servicio->entregar(102),
    fn() => $servicio->cancelar(104),
    fn() => $servicio->entregar(106),
    fn() => $servicio->enviar(999),
];

foreach ($operaciones as $i => $op) {
    try {
        $op();
        echo "Paso " . ($i + 1) . " correcto" . PHP_EOL;
    } catch (EnvioException|InvalidArgumentException $e) {
        echo "Paso " . ($i + 1) . " rechazo: " . $e->getMessage() . PHP_EOL;
    }
}

foreach ($servicio->consultar(estado: EstadoEnvio::Pendiente) as $envio) {
    echo "Pendiente: " . $envio->id() . PHP_EOL;
}
print_r($servicio->resumir($repositorio->todos()));

// 6.2 Datos invalidos y limites
$casosInvalidos = [
    fn() => new EnvioNormal(0, 'Cliente', 1000, EstadoEnvio::Pendiente),
    fn() => new EnvioNormal(-1, 'Cliente', 1000, EstadoEnvio::Pendiente),
    fn() => new EnvioNormal(200, '', 1000, EstadoEnvio::Pendiente),
    fn() => new EnvioNormal(201, '   ', 1000, EstadoEnvio::Pendiente),
    fn() => new EnvioNormal(202, 'Cliente', 0, EstadoEnvio::Pendiente),
    fn() => new EnvioNormal(203, 'Cliente', -1, EstadoEnvio::Pendiente),
    fn() => new EnvioNormal(204, 'Cliente', 20001, EstadoEnvio::Pendiente),
];

foreach ($casosInvalidos as $caso) {
    try {
        $caso();
    } catch (InvalidArgumentException $e) {
        echo "Error esperado: " . $e->getMessage() . PHP_EOL;
    }
}

$envioEspacios = new EnvioNormal(300, '   Cliente   con   espacios   ', 1000, EstadoEnvio::Pendiente);
echo $envioEspacios->cliente() . PHP_EOL;

$limites = [1, 1000, 1001, 20000];
foreach ($limites as $p) {
    $norm = new EnvioNormal(400, 'Test', $p, EstadoEnvio::Pendiente);
    $urg = new EnvioUrgente(401, 'Test', $p, EstadoEnvio::Pendiente);
    echo "Peso $p: normal=" . $norm->tarifa() . " urgente=" . $urg->tarifa() . PHP_EOL;
}

try {
    $repositorio->registrar(new EnvioNormal(101, 'Duplicado', 1000, EstadoEnvio::Pendiente));
} catch (EnvioException $e) {
    echo "Rechazo duplicado: " . $e->getMessage() . PHP_EOL;
}
echo "Total envios: " . count($repositorio->todos()) . PHP_EOL;

var_dump($repositorio->buscar(999));

try {
    $repositorio->buscar(0);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

try {
    $servicio->enviar(0);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

try {
    $servicio->consultar(modalidad: 'desconocida');
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

try {
    $servicio->consultar(orden: 'desconocido');
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

$repoVacio = new RepositorioEnviosMemoria();
$servicioVacio = new ServicioEnvios($repoVacio);

try {
    $servicioVacio->consultar(modalidad: 'desconocida');
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

try {
    $servicioVacio->consultar(orden: 'desconocido');
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

print_r($servicioVacio->consultar());
print_r($servicioVacio->etiquetas([]));
print_r($servicioVacio->resumir([]));
