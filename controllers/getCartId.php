<?php
session_start();
require_once "../db/connect.php";

$sql_products = "select product_id from cart where cart.email = :login";
$query_products = $pdo -> prepare($sql_products);
$query_products -> execute([
    'login' => $_SESSION['login']
]);
$needed_product = $query_products -> fetchAll();
echo json_encode($needed_product);
?>