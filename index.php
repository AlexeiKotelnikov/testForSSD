<?php

declare(strict_types=1);

use View\View;

try {
    define("BASE_URL", '/testForSSD');
    spl_autoload_register(function ($name) {
        require_once __DIR__ . '/src/' . str_replace('\\', '/', $name) . '.php';
    });

    $route = $_GET['route'] ?? '';
    var_dump($route);
    $routes = require __DIR__ . '/src/routes.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);

        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        throw new Exceptions\NotFoundException();
    }

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName(...$matches);
} catch (Exceptions\DbException $e) {
    $view = new View(__DIR__ . '/templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
} catch (Exceptions\NotFoundException $e) {
    $view = new View(__DIR__ . '/templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
}