<?php
session_start();
require_once "../db/connect.php";

$sql_products = "select * from products where category_id = :id order by product_price";
$query_products = $pdo -> prepare($sql_products);
$query_products -> execute([
        'id' => json_decode($_POST['data'],true)[0]
]);
$needed_product = $query_products -> fetchAll();
echo json_encode($needed_product);
?>