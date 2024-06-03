<?php
declare(strict_types=1);
namespace App;

require __DIR__ . '/../vendor/autoload.php';

use Inforisorse\OdtPhp\Odf;

$templateName = 'documento_complesso';

$templateDir = realpath(__DIR__ . '/../storage/templates/odt') . '/';
$imageDir = realpath(__DIR__ . '/../storage/templates/images') . '/';
$outputDir = realpath(__DIR__ . '/../storage/generated') . '/';

$template = $templateDir . $templateName . '.odt';
$odtFile = $outputDir . $templateName. '.odt';
$header_logo = $imageDir . 'header_logo.png';

$odf = new Odf($template, []);

$odf->setImage('header_logo', $header_logo);

$odf->setVars('variabile_1', 'Prima stringa sostituita');
$odf->setVars('variabile_2', 'Seconda stringa sostituita');

$odf->setVars('valore_1', 'Valore 1');
$odf->setVars('valore_2', 'Valore 2');
$odf->setVars('valore_3', 'Valore 3');
$odf->setVars('valore_4', 'Valore 4');
$odf->setVars('valore_5', 'Valore 5');


$odf->saveToDisk($odtFile);

$cmd = sprintf('libreoffice --headless --convert-to pdf %s --outdir %s' ,$odtFile, $outputDir);
$result = @shell_exec($cmd);
unlink($odtFile);
echo $result;