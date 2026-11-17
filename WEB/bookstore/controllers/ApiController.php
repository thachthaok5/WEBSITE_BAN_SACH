<?php
require_once __DIR__ . '/../core/Controller.php';

class ApiController extends Controller
{
    public function index()
    {
        require __DIR__ . '/../api/index.php';
    }

    public function __call($name, $arguments)
    {
        if (empty($_GET['endpoint'])) {
            $_GET['endpoint'] = $name;
        }
        require __DIR__ . '/../api/index.php';
    }
}
