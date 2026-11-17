<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Product.php';

class HomeController extends Controller
{
    public function index()
    {
        $productModel = new Product();
        $products = $productModel->getAll();

        // Categorize for rich homepage presentation
        $books = array_filter($products, function ($p) {
            return (int)($p['LoaiSP'] ?? 0) === 1;
        });

        $stationery = array_filter($products, function ($p) {
            return (int)($p['LoaiSP'] ?? 0) === 2;
        });

        $featuredProducts = array_slice($products, 0, 8);

        $this->view('home/index', [
            'title' => 'BookStore - Hiệu Sách & Văn Phòng Phẩm Tuyển Chọn',
            'featuredProducts' => $featuredProducts,
            'products' => $products,
            'books' => array_values(array_slice($books, 0, 8)),
            'stationery' => array_values(array_slice($stationery, 0, 8))
        ]);
    }
}
