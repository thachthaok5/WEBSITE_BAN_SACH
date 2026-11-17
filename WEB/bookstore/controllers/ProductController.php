<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Product.php';

class ProductController extends Controller
{
   public function list()
{
    $productModel = new Product();

    $limit = 10;
    $page = max(1, (int)($_GET['page'] ?? 1));
    $offset = ($page - 1) * $limit;

    $products = $productModel->getPaginated($limit, $offset);
    $totalProducts = $productModel->countAll();

    $totalPages = ceil($totalProducts / $limit);

    $this->view('product/list', [
        'title' => 'Danh sách sản phẩm',
        'products' => $products,
        'currentPage' => $page,
        'totalPages' => $totalPages
    ]);
}

    public function detail()
    {
        $id = (int)($_GET['id'] ?? 0);

        $productModel = new Product();
        $product = $productModel->getById($id);

        if (!$product) {
            die('Sản phẩm không tồn tại');
        }

        $this->view('product/detail', [
            'title' => 'Chi tiết sản phẩm',
            'product' => $product
        ]);
    }

    public function search()
    {
        $keyword = trim($_GET['keyword'] ?? '');

        $productModel = new Product();

        if ($keyword === '') {
            $products = $productModel->getAll();
        } else {
            $products = $productModel->searchByName($keyword);
        }

        $this->view('product/list', [
            'title' => 'Tìm kiếm sản phẩm',
            'products' => $products,
            'keyword' => $keyword
        ]);
    }

    public function category()
    {
        $loaiSP = (int)($_GET['loai'] ?? 0);

        $productModel = new Product();

        if (!in_array($loaiSP, [1, 2], true)) {
            $products = $productModel->getAll();
            $title = 'Danh sách sản phẩm';
        } else {
            $products = $productModel->getByCategory($loaiSP);
            $title = ($loaiSP === 1) ? 'Sách' : 'Văn phòng phẩm';
        }

        $this->view('product/list', [
            'title' => $title,
            'products' => $products,
            'currentCategory' => $loaiSP
        ]);
    }
}