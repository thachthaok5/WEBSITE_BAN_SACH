<?php

class Router
{
    private string $defaultController = 'HomeController';
    private string $defaultAction = 'index';

    public function dispatch(): void
    {
        $controllerParam = $_GET['controller'] ?? 'home';
        $action = $_GET['action'] ?? $this->defaultAction;

        $controllerName = ucfirst(strtolower($controllerParam)) . 'Controller';
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            $this->abort("Controller không tồn tại: {$controllerName}");
        }

        require_once $controllerFile;

        if (!class_exists($controllerName)) {
            $this->abort("Class controller không tồn tại: {$controllerName}");
        }

        $controllerObject = new $controllerName();

        if (!method_exists($controllerObject, $action)) {
            $this->abort("Action không tồn tại: {$action}");
        }

        call_user_func([$controllerObject, $action]);
    }

    private function abort(string $message): void
    {
        http_response_code(404);
        die($message);
    }
}