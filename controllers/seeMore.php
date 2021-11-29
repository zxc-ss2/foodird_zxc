<?php
    session_start();
    require_once "../db/connect.php";

    $count_element = json_decode($_POST['id'],true)[2];
    $products = array();
        $sql_products = "select product_id, discount_value, product_name, product_price, product_path from products inner join discounts 
                        on products.discount_id = discounts.discount_id where products.discount_id != 21 and products.product_id != :id1
                        and products.product_id != :id2 and products.product_id != :id3 order by rand() limit 18";
        $query_products = $pdo -> prepare($sql_products);
        $query_products -> execute([
            'id1' => json_decode($_POST['id'],true)[0],
            'id2' => json_decode($_POST['id'],true)[1],
            'id3' => json_decode($_POST['id'],true)[2]
        ]);
        array_push($products, $query_products -> fetchAll());

    echo json_encode($products);

?>