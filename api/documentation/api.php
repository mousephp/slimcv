<?php

require('../../vendor/autoload.php');
//or
// require($_SERVER['DOCUMENT_ROOT'].'/_slim/slimcv/vendor/autoload.php');

$openapi = \OpenApi\Generator::scan([$_SERVER['DOCUMENT_ROOT'].'/_slim/slimcv/app/Controllers']);

header('Content-Type: application/json');

echo $openapi->toJSON();


