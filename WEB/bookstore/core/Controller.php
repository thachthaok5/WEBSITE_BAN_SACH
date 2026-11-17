<?php

class Controller
{
    public function view(string $viewPath, array $data = []): void
    {
        extract($data);

        $fullPath = __DIR__ . '/../views/' . $viewPath . '.php';

        if (file_exists($fullPath)) {
            require_once $fullPath;
        } else {
            die("View không tồn tại: {$viewPath}");
        }
    }

    public function model(string $modelName)
    {
        $modelPath = __DIR__ . '/../models/' . $modelName . '.php';

        if (file_exists($modelPath)) {
            require_once $modelPath;

            if (class_exists($modelName)) {
                return new $modelName();
            }

            die("Class model không tồn tại: {$modelName}");
        }

        die("Model không tồn tại: {$modelName}");
    }

    public function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}