<?php
    session_start();
    require_once "../db/connect.php";

    $sql_removed_product = "delete from cart where product_id = :id";
    $query_removed_product = $pdo -> prepare($sql_removed_product);
    $query_removed_product -> execute([
        'id' => json_decode($_POST['id']),
    ]);
    $removed_product[] = $query_removed_product -> fetchAll();
?>