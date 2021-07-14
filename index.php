<?php

require_once __DIR__ . '/includes/app.php';

use App\Http\Router;

$router = new Router(URL);

require_once __DIR__ . '/routes/pages.php';

$router->run()->sendResponse();