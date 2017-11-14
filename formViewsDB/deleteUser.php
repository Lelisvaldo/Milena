<?php
    if(!isset($_SESSION)){session_start();}
    include "../conn.php";

    $deleteUser = $pdo->prepare("CALL sp_deleteUser('".$_SESSION['idUser']."');");
    $deleteUser->execute();

    session_destroy();
    header('location:../index.php');