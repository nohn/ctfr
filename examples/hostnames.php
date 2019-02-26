#!/usr/bin/env php
<?php
$domain = $_SERVER['argv'][1];

require_once __DIR__ . '/../vendor/autoload.php';

$certs = \Nohn\CTFR::query($domain);

$names = array();

foreach ($certs as $cert) {
    $names[] = $cert->name_value;
}
$names = array_unique($names);
foreach ($names as $name) {
    echo "$name\n";
}