<?php
require_once "../db/connect.php";
session_start();

if(isset($_POST['username']) && isset($_POST['pass'])){
    $login = $_POST['username'];
    $password = $_POST['pass'];

    $sql = "select password from users where email = :login";
    $query = $pdo -> prepare($sql);
    $query -> execute(array(
        'login' => $login
    ));

    $info = $query -> fetchAll(PDO::FETCH_ASSOC);
    $hashed_password = $info[0]['password'];
    echo $info[0]['password'];

    if(password_verify($password, $hashed_password)){
        $sql = "select * from users where email = :login and password = :hashed_password";
        $query = $pdo -> prepare($sql);
        $query -> execute(array(
            'login' => $login,
            'hashed_password' => $hashed_password
        ));
        $result = $query -> fetchAll(PDO::FETCH_ASSOC);

        if(!empty($result)){
            $_SESSION['login'] = $login;
            $_SESSION['role'] = $result[0]['role'];
            header("Location: ../cart/index.php");
        }
    }
    else{
        echo "Неверный логин или пароль";
    }
}
?>