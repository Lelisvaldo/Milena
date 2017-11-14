<?php
    ini_set('default_charset','UTF-8');
    // session_start inicia a sessão
    if(!isset($_SESSION)){session_start();}
    include "../conn.php";

    $datetimeBefore = $_POST['datetimeBefore'];
    $datetimeAfter = $_POST['datetimeAfter'];


    $seleAgendamento= $pdo->prepare ("SELECT dt_hr_agendamento, nm_servico, ds_servico 
                                                FROM tb_agendamento
                                                INNER JOIN tb_servico ON tb_agendamento.cd_servico = tb_servico.cd_servico
                                                WHERE (dt_hr_agendamento >= :dhiAgendamento) AND (dt_hr_agendamento <= :dhfAgendamento);
    ");
    $seleAgendamento->bindParam(':dhiAgendamento', $datetimeBefore, PDO::PARAM_STR);
    $seleAgendamento->bindParam(':dhfAgendamento', $datetimeAfter, PDO::PARAM_STR);
    $seleAgendamento->execute();
    $results = $seleAgendamento->fetch(PDO::FETCH_ASSOC);

    var_dump($results);