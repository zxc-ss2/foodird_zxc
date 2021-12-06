<?php 
require_once "../db/connect.php";
session_start();

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['repeat-pass'])){
    if($_POST['pass'] == $_POST['repeat-pass']){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $confirm_password = $_POST['repeat-pass'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "select email from users where email = :email";
        $query = $pdo -> prepare($sql);
        $query -> execute([ 
            'email' => $email
            ]
        );
        $users = $query ->fetchAll(PDO::FETCH_ASSOC);


        if(empty($users)){

            $sql = "insert into users(name, email, password, role_id) values(:name, :email, :password, :role)";
            $query = $pdo -> prepare($sql);
            $query -> execute(array(
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password,
                'role' => 2
            ));
            $_SESSION['login'] = $email;
            header("Location: ../account/index.php");
        }

        else{
            $_SESSION['message'] = "Пользователь с такми логином уже зарегистрирован.";
            header("Location: ../reglog/reg.php");
        }
    }
    else{
        $_SESSION['message'] = "Пароли не совпадают.";
        header("Location: ../reglog/log.php");
    }
}

?>