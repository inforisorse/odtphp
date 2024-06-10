<?php
declare(strict_types=1);
namespace App;

require __DIR__ . '/../vendor/autoload.php';

use Inforisorse\OdtPhp\Odf;

$templateName = 'privacy_condominio';

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
    'indirizzo_condominio' => 'Via degli studenti 3',
    'cap_condominio' => '10142',
    'localita_condominio' => 'Torino',
    'provincia_condominio' => 'TO',
    'cf_condominio' => '19281764276',
    'amministratore' => 'Tizio Caio',
    'responsabile_privacy_studio' => 'Sempronio Caio',
    'nome_studio' => 'Caio Amministrazioni',
    'indirizzo_studio' => 'Via qualunque 5',
    'cap_studio' => '10421',
    'localita_studio' => 'Beinasco',
    'provincia_studio' => 'TO',
    'update_page_url' => 'https://www.caio.it',


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