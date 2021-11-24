<?php
session_start();
require_once "../db/connect.php";

$sql_products = "select * from products inner join categories on products.category_id = categories.category_id inner join discounts on products.discount_id
= discounts.discount_id where products.category_id = :id";
$query_products = $pdo -> prepare($sql_products);
$query_products -> execute([
        'id' => json_decode($_POST['id'])
]);
$needed_product = $query_products -> fetchAll();
echo json_encode($needed_product);
?>