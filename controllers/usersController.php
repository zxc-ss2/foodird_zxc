<?php
require_once "../db/connect.php";
session_start();

//------------------sigh up----------------------------//
function signup(){
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
                $sql = "insert into users(name, email, password) values(:name, :email, :password)";
                $query = $pdo -> prepare($sql);
                $query -> execute(array(
                    'name' => $name,
                    'email' => $email,
                    'password' => $hashed_password
                ));
    
                header("Location: ../account/index.php");
            }
    
            else{
                $_SESSION['message'] = "Пользователь с такми логином уже зарегистрирован.";
            }
        }
        else{
            $_SESSION['message'] = "Пароли не совпадают.";
        }
    }
}

function signin(){
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
                header("Location: ../account/index.php");
            }
        }
        else{
            echo "Неверный логин или пароль";
        }
    }
}

?>