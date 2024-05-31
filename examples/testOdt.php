<?php
declare(strict_types=1);
namespace App;

require __DIR__ . '/../../../../vendor/autoload.php';

use Inforisorse\OdtPhp\Odf;

$template = realpath(__DIR__ . '/../../../../storage/templates/odt') . '/documento_1.odt';

$odf = new Odf($template, []);
$odf->setVars('variabile_1', 'Prima stringa sostituita');
$odf->setVars('variabile_2', 'Seconda stringa sostituita');

$outputFile = realpath(__DIR__ . '/../../../../storage/generated') . '/documento_1.odt';
$odf->saveToDisk($outputFile);
