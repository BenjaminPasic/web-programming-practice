<?php
require_once dirname(__FILE__).'/../../vendor/autoload.php';
$openapi = \OpenApi\scan(dirname(__FILE__).'/../routes');
header('Content-type: application/json');
echo $openapi->toJson();
?>