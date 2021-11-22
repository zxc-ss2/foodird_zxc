<?php
session_start();
require_once "../db/connect.php";

$sql_products = "select max(product_price) from products where category_id = :id";
$query_products = $pdo -> prepare($sql_products);
$query_products -> execute([
        'id' => json_decode($_POST['id'])
]);
$needed_product = $query_products -> fetchAll();
echo json_encode($needed_product);
?>