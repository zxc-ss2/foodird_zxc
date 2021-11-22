<?php
    session_start();
    require_once "../db/connect.php";
    echo $_POST['id'];

    $sql_products = "select * from cart where email = :email and product_id = :id";
    $query_products = $pdo -> prepare($sql_products);
    $query_products -> execute([
        'email' => $_SESSION['login'],
        'id' => $_POST['id']
    ]);

    $needed_product = $query_products -> fetchAll();
    echo json_encode(count($needed_product));
    
    if(empty($needed_product)){
        $sql = "insert into cart(product_id, email) values(:id, :us_id)";
        $query = $pdo -> prepare($sql);
        $query -> execute([
            'id' => $_POST['id'],
            'us_id' => $_SESSION['login']
        ]);
    }

?>