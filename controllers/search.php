<?php
session_start();
require_once "../db/connect.php";

$text = json_decode($_POST['info'],true);
$sql_products = "SELECT * FROM products WHERE product_name LIKE '%{$text}%'";
$query_products = $pdo -> prepare($sql_products);
$query_products -> execute();
$needed_product = $query_products -> fetchAll();
echo json_encode($needed_product);
?>