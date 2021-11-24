<?php
session_start();
require_once "../db/connect.php";

$sql = "update users set name = :name, email = :email where email = :login";
$query = $pdo -> prepare($sql);
$query -> execute([
    'name' => json_decode($_POST['data'],true)[0],
    'email' => json_decode($_POST['data'],true)[1],
    'login' => $_SESSION['login']
]);


?>