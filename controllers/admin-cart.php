<?php
session_start();
require_once "../db/connect.php";
$sql_products = "delete from cart where cart_id = :id";
$query_products = $pdo -> prepare($sql_products);
$query_products -> execute([
        'id' => json_decode($_POST['id'],true)
]);


?>