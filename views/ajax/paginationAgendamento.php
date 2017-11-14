<?php ini_set('default_charset','UTF-8');
    include('../../conn.php');

    $limit = 13;
    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
    $start_from = ($page-1) * $limit;

    $datetimeBefore = '';
    $datetimeAfter = '';


    if(isset($_POST['dateBefore'])) {
        $datetimeBefore = $_POST['datetimeBefore'];
        $datetimeAfter = $_POST['datetimeAfter'];
    }

    $selectAgendamento = $pdo->prepare ("SELECT cd_agendamento, nm_usuario, nm_servico, dt_hr_agendamento
                                              FROM  tb_agendamento
                                              INNER JOIN tb_servico
                                                ON tb_agendamento.cd_servico = tb_servico.cd_servico
                                              INNER JOIN tb_usuario
                                                ON tb_agendamento.cd_usuario = tb_usuario.cd_usuario
                                            WHERE (tb_agendamento.dt_hr_agendamento >= :dhiAgendamento) AND (tb_agendamento.dt_hr_agendamento >= :dhfAgendamento)
                                            ORDER BY nm_usuario ASC LIMIT :inicio,:limite
        ");
    $selectAgendamento->bindParam(':dhiAgendamento', $datetimeBefore, PDO::PARAM_STR);
    $selectAgendamento->bindParam(':dhfAgendamento', $datetimeAfter, PDO::PARAM_STR);
    $selectAgendamento->bindParam(':inicio', $start_from, PDO::PARAM_INT);
    $selectAgendamento->bindParam(':limite', $limit, PDO::PARAM_INT);
    $selectAgendamento->execute();
//    $results = $selectAgendamento->fetchAll(PDO::FETCH_ASSOC);
//    var_dump($results);
?>

    <table class="table" id="inboxTable">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Serviço</th>
                <th>Data</th>
                <th>Hora</th>
            </tr>
    </thead>
    <tbody class="table">
    <?php while ($results = $selectAgendamento->fetch(PDO::FETCH_ASSOC)){
        $dateTime = $results["dt_hr_agendamento"]; //recebe a variavel que Possue o nome
        $sDateTime = explode(" ",$dateTime); //explode
    ?>
        <tr>
            <td><?php echo $results["nm_usuario"]; ?></td>
            <td><?php echo $results["nm_servico"]; ?></td>
            <td><?php echo $sDateTime[0]; ?></td>
            <td><?php echo $sDateTime[1]; ?></td>
        </tr>
    <?php }; ?>
    </tbody>
    </table>
