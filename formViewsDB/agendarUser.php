<?php
    ini_set('default_charset','UTF-8');
    // session_start inicia a sessão
    if(!isset($_SESSION)){session_start();}
    include "../conn.php";

    $dT = $_POST['dT'];
    $cboServico = $_POST['cboServico'];

//    echo $dT;
//    echo " ";
//    echo $cboServico;
//    echo " ";
//    echo $_SESSION['idUser'];

    $insertAgendamento = $pdo->prepare ("INSERT INTO tb_agendamento (cd_agendamento, dt_hr_agendamento, cd_servico, cd_usuario)
                                                  VALUES (DEFAULT, :dTAgendamento, :idServico, :idUser);");
    $insertAgendamento->bindParam(':dTAgendamento', $dT);
    $insertAgendamento->bindParam(':idServico', $cboServico);
    $insertAgendamento->bindParam(':idUser', $_SESSION['idUser']);
    $insertAgendamento->execute();
