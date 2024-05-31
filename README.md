# Inforisorse OdtPHP


Forked from https://github.com/MarcosBL/odtphp

OdtPHP is a library to quickly generate Open Document Text-files that can be read by a **gigantic set** of Office Suites, including LibreOffice, OpenOffice and even Microsoft Office from PHP code. It uses a simple templating mechanism.

Ported to php 8.1+

## Usage

in composer.json:

```json
"repositories": [
    {
        "type": "vcs",
        "url":  "https://github.com/inforisorse/odtphp.git"
    }
],
"require": {
    "ext-zip": "*",
    "inforisorse/odtphp": "dev-main"
}

```

simple find & replace in odt document:

```php

<?php
declare(strict_types=1);
namespace App;

require __DIR__ . '/../vendor/autoload.php';

use Inforisorse\OdtPhp\Odf;

$template = realpath(__DIR__ . '/../storage/templates/odt') . '/documento_1.odt';

$odf = new Odf($template, []);
$odf->setVars('variabile_1', 'Prima stringa sostituita');
$odf->setVars('variabile_2', 'Seconda stringa sostituita');

$outputFile = realpath(__DIR__ . '/../storage/generated') . '/documento_1.odt';
$odf->saveToDisk($outputFile);
```

