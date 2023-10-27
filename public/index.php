<?php declare(strict_types=1);

// php -S localhost:8080 index.php

$url =  $_SERVER["REQUEST_URI"]?? '';
$path = parse_url($url, PHP_URL_PATH);
if (preg_match('/\.css$/', $path)) {
	return false;
}

require '../src/main.php';
