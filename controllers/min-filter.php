<?php
session_start();
require_once "../db/connect.php";

$sql_products = "select * from products inner join discounts on products.discount_id = discounts.discount_id where product_price > :price and category_id = :id";
$query_products = $pdo -> prepare($sql_products);
$query_products -> execute([
        'price' => json_decode($_POST['data'],true)[0],
        'id' => json_decode($_POST['data'],true)[1]
]);
$needed_product = $query_products -> fetchAll();
echo json_encode($needed_product);
?>