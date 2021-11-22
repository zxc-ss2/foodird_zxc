<?php
session_start();
require_once "../db/connect.php";

$back_product_sql = "insert into cart(product_id, email) values (:id, :email)";
$back_product_query = $pdo -> prepare($back_product_sql);
$back_product_query -> execute([
    'product_id' => json_decode($_POST['id']),
    'email' => $_SESSION['login']
]);

echo json_decode($_POST['id']);
?>