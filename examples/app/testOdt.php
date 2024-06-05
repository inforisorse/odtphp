<?php
declare(strict_types=1);
namespace App;

require __DIR__ . '/../vendor/autoload.php';

use Inforisorse\OdtPhp\Odf;

$templateName = 'documento_complesso';

$templateDir = realpath(__DIR__ . '/../storage/templates/odt') . '/';
$imageDir = realpath(__DIR__ . '/../storage/templates/images') . '/';
$outputDir = realpath(__DIR__ . '/../storage/generated') . '/';
$pdfFile = $outputDir . $templateName . '.pdf';

$template = $templateDir . $templateName . '.odt';
$odtFile = $outputDir . $templateName. '.odt';
$header_logo = $imageDir . 'header_logo.png';

$odf = new Odf($template, []);

// IMAGES REPLACEMENTS
$images = [
    'header_logo' => [
        'file' => $header_logo
    ],
];

// STRING REPLACEMENTS
$strings = [
    'variabile_1' => 'Prima stringa sostituita',
    'variabile_2' => 'Seconda stringa sostituita',
    'valore_1' => 'Valore dinamico UNO',
    'valore_2' => 'Valore dinamico DUE',
    'valore_3' => 'Valore dinamico TRE',
    'valore_4' => 'Valore dinamico QUATTRO',
    'valore_5' => 'Valore dinamico CINQUE',

];

$odf->setImages($images);
$odf->setStringVars($strings);

/*
$odf->saveToDisk($odtFile);

$cmd = sprintf('libreoffice --headless --convert-to pdf %s --outdir %s' ,$odtFile, $outputDir);
$result = @shell_exec($cmd);
unlink($odtFile);
echo $result;

*/

$odf->saveToDiskAsPdf($pdfFile);