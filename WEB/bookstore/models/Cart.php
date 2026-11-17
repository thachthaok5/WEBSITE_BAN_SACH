<?php

class Cart
{
    public function getItems(): array
    {
        return $_SESSION['cart'] ?? [];
    }

    public function add(int $id, array $product, int $qty = 1): void
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$id] = [
                'name'  => $product['TenSP'],
                'price' => (int)$product['GiaBan'],
                'qty'   => $qty
            ];
        }
    }

    public function update(array $quantities): void
    {
        if (!isset($_SESSION['cart'])) {
            return;
        }

        foreach ($quantities as $id => $qty) {
            $id = (int)$id;
            $qty = (int)$qty;

            if (isset($_SESSION['cart'][$id])) {
                if ($qty <= 0) {
                    unset($_SESSION['cart'][$id]);
                } else {
                    $_SESSION['cart'][$id]['qty'] = $qty;
                }
            }
        }
    }

    public function remove(int $id): void
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
    }

    public function clear(): void
    {
        unset($_SESSION['cart']);
    }

    public function getTotal(): int
    {
        $total = 0;
        $items = $this->getItems();

        foreach ($items as $item) {
            $total += ((int)$item['price'] * (int)$item['qty']);
        }

        return $total;
    }

    public function countItems(): int
    {
        $count = 0;
        $items = $this->getItems();

        foreach ($items as $item) {
            $count += (int)$item['qty'];
        }

        return $count;
    }

    public function isEmpty(): bool
    {
        return empty($this->getItems());
    }
}