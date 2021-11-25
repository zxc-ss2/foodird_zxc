<?php
session_start();
require_once "../db/connect.php";

$hashed_password = password_hash(json_decode($_POST['data'],true)[0], PASSWORD_DEFAULT);
echo $hashed_password;

$sql = "update users set password = :pass where email = :login";
$query = $pdo -> prepare($sql);
$query -> execute([
    'pass' => $hashed_password,
    'login' => $_SESSION['login']
]);

?>