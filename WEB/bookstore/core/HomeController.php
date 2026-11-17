<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Product.php';

class HomeController extends Controller
{
    public function index(): void
    {
        $productModel = new Product();
        $products = $productModel->getAll();

        $this->view('home/index', [
            'title' => 'Trang chủ',
            'products' => $products
        ]);
    }
}