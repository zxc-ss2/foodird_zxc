<?php
session_start();
require_once "../db/connect.php";

if(isset($_POST['new-name']) && isset($_POST['new-email'])){
    $new_name = $_POST['new-name'];
    $new_email = $_POST['new-email'];

    $sql = "update users set name = :name, email = :email where email = :login";
    $query = $pdo -> prepare($sql);
    $query -> execute([
        'name' => $new_name,
        'email' => $new_email,
        'login' => $_SESSION['login']
    ]);
header("Location: ../account/index.php");


}


?>