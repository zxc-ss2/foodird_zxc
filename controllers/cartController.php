<?php
session_start();
require_once "../db/connect.php";

    $sql_id = "select product_id from cart";
    $query_id = $pdo -> prepare($sql_id);
    $query_id -> execute();
    $id = $query_id ->fetchAll(PDO::FETCH_ASSOC);

    $cart_products = array();

    foreach ($id as $key) {
        $sql_cart_products = "select product_name, product_path, product_price from products where product_id = :product";
        $query_cart_products = $pdo -> prepare($sql_cart_products);
        $query_cart_products -> execute([
            'product' => $key['product_id']
        ]);
        $cart_products[] = $query_cart_products -> fetchAll();
    }
?>