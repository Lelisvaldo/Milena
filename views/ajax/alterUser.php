<?php
    include("../../conn.php");

    // Recebe o valor enviado
    $cdUser = $_POST['codUser'];
    $sAdmin = $_POST['statusAdmin'];

    // Procura titulos no banco relacionados ao valor
    $alterUser = $pdo->prepare ("CALL sp_updateStatusAdmUser(:cdUser, :sAdmin);");
    $alterUser->bindParam(':cdUser',$cdUser, PDO::PARAM_INT);
    $alterUser->bindParam(':sAdmin',$sAdmin, PDO::PARAM_INT);
    $alterUser->execute();
