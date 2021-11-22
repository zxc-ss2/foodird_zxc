<?php
    session_start();
    require_once "../db/connect.php";

    $zxc = array();

    foreach (json_decode($_POST['id'], true) as $key) { 
        $sql_products = "select product_name, products.product_id, product_price, product_path from products left outer join cart on products.product_id = cart.product_id where category_id = :id and cart.cart_id is null";
        $query_products = $pdo -> prepare($sql_products);
        $query_products -> execute([
            'id' => $key
        ]);
        array_push($zxc, $query_products -> fetchAll());
    }
    echo json_encode($zxc);



?>