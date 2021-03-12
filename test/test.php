<?php

use GuzzleHttp\Client;
use Kuvardin\FieldsScanner\FieldsScanner;
use Overfair\StatGovSDK\Api;

require 'vendor/autoload.php';

$bins = [
    '030840008029',
    '110640019728',
    '801218350190',
    '021040006916',
    '180540013718',
    '550310301681',
    '730725401365',
    '160340008750',
    '081040002835',
    '970240000314',
    '191140009600',
    '800304400115',
    '140240004582',
    '830421402123',
    '090940000593',
    '860119450921',
    '770617300013',
    '180840025623',
    '070440000551',
    '081040005691',
    '771013401532',
    '200740025656',
    '050140004768',
    '560309300868',
    '161140005642',
    '170940011893',
    '850111450855',
    '820129450045',
    '990140002073',
    '071040000966',
];

$client = new Client();
$api = new Api($client);
$scanner = new FieldsScanner;

$is_first = true;
foreach ($bins as $bin) {
    foreach (Api::LANGS as $lang_code) {
        while (true) {
            try {
                $is_first ?: usleep(6000000);
                $is_first = false;
                $response = $api->getOrganization($bin, $lang_code);
                $scanner->scan($response);
                echo (new DateTime())->format('H:i:s:u'), " Success in $lang_code [$bin]\n";
                break;
            } catch (\GuzzleHttp\Exception\GuzzleException $exception) {
                echo (new DateTime())->format('H:i:s:u'), " #{$exception->getCode()}: {$exception->getMessage()}\n";
            }
        }
    }
}

echo $scanner->result->getInfo(), PHP_EOL;