<?php
session_start();
require_once "../db/connect.php";

echo json_decode($_POST['id'],true)[0];
$sql_products = "delete from purchases where user_id = :id";
$query_products = $pdo -> prepare($sql_products);
$query_products -> execute([
        'id' => json_decode($_POST['id'],true)
]);

$sql_products = "delete from users where user_id = :id";
$query_products = $pdo -> prepare($sql_products);
$query_products -> execute([
        'id' => json_decode($_POST['id'],true)
]);


?>