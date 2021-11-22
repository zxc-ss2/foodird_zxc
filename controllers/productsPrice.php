<?php
    session_start();
    require_once "../db/connect.php";

    $sql_cart_products = "select product_id, product_name, product_path, product_price from products where product_id = :product";
        $query_cart_products = $pdo -> prepare($sql_cart_products);
        $query_cart_products -> execute([
            'product' => $key['product_id']
        ]);
        $cart_products[] = $query_cart_products -> fetchAll();
    echo json_encode(count($needed_product));

?>