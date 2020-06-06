<?php

require("../../vendor/autoload.php");
$openapi = \OpenApi\scan('../../app/Http/Controllers');
header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
