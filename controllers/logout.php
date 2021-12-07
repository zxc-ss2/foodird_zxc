<?php
session_start();
unset($_SESSION["login"]);

header("Location: ../reglog/log.php");
?>