<?php

declare(strict_types=1);

$patron = '/^LIB-\d{4}-\d{4}$/';

$codigosAProbar = [
    'LIB-2026-0042',
    'LIB-26-0042',
    'REV-2026-0042',
];

foreach ($codigosAProbar as $codigo) {
    $resultado = preg_match($patron, $codigo);
    echo "$codigo => " . var_export($resultado, true) . PHP_EOL;
}
