<?php
session_start();
require_once "../db/connect.php";

$update_user = "update users set name = :name, surname = :surname, email = :email where email = :login";
$query_update_user = $pdo -> prepare($update_user);
$query_update_user -> execute([
    'name' => json_decode($_POST['info'],true)[0],
    'surname' => json_decode($_POST['info'],true)[1],
    'email' => json_decode($_POST['info'],true)[2],
    'login' => $_SESSION['login']
]);

header("Location: ../reglog/log.php");
?>