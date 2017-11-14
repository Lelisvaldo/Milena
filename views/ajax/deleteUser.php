<?php
    include("../../conn.php");

    // Recebe o valor enviado
    $cdUser = $_POST['cdUser'];


    // Procura titulos no banco relacionados ao valor
    $alterUser = $pdo->prepare ("CALL sp_deleteUser(:cdUser);");
    $alterUser->bindParam(':cdUser',$cdUser, PDO::PARAM_INT);
    $alterUser->execute();