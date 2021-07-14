<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Utils\View;
use App\Utils\Environment;
use App\Model\Database;

Environment::load(__DIR__ . '/../');

Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);

define('URL', getenv('URL'));

View::init([
    'URL' => URL
]);