# PHP SKD for stat.gov.kz API
## Installation
```shell
composer require "overfair/stat-gov-sdk: dev-main"
```
## Usage example

```php
<?php

use GuzzleHttp\Client;
use Kuvardin\FieldsScanner\FieldsScanner;
use Overfair\StatGovSDK\Api;
use Overfair\StatGovSDK\Exceptions\ApiException;

require 'vendor/autoload.php';

$client = new Client();
$api = new Api($client);
$scanner = new FieldsScanner;

$biin = 'XXXXXXXXXXXX';
try {
    $organization = $api->getOrganization($biin);
    print_r($organization);
} catch (ApiException $api_exception) {
    echo $api_exception->getMessage(), PHP_EOL;
}
```