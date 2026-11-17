<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Cart.php';
require_once __DIR__ . '/../models/Product.php';

class CartController extends Controller
{
    private function requireLogin()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('index.php?controller=auth&action=login');
        }
    }

    public function index()
    {
        $this->requireLogin();

        $cartModel = new Cart();
        $cart = $cartModel->getItems();

        $this->view('cart/index', ['cart' => $cart]);
    }

    public function add()
    {
        $this->requireLogin();

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect('index.php?controller=product&action=list');
        }

        $productModel = new Product();
        $product = $productModel->getById($id);

        if (!$product) {
            die('Sản phẩm không tồn tại.');
        }

        $cartModel = new Cart();
        $cartModel->add($id, $product, 1);

        $this->redirect('index.php?controller=cart&action=index');
    }

    public function update()
    {
        $this->requireLogin();

        $quantities = $_POST['qty'] ?? [];

        $cartModel = new Cart();
        $cartModel->update($quantities);

        $this->redirect('index.php?controller=cart&action=index');
    }

    public function delete()
    {
        $this->requireLogin();

        $id = (int)($_GET['id'] ?? 0);

        $cartModel = new Cart();
        $cartModel->remove($id);

        $this->redirect('index.php?controller=cart&action=index');
    }
}