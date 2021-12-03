<?php
$pdo = new PDO('mysql:host=localhost;port=3307;dbname=foodird;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
?>