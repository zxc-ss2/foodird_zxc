<?php
session_start();
require_once "../db/connect.php";

$sql_products = "select * from cart";
$query_products = $pdo -> prepare($sql_products);
$query_products -> execute([
    'email' => $_SESSION['login'],
    'id' => $_POST['id']
]);
$needed_product = $query_products -> fetchAll();

echo json_encode($needed_product);
?>