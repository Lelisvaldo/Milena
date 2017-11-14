<?php
    ini_set('default_charset','UTF-8');
    include("../../conn.php");

    // Recebe o valor enviado
    $nameUser = $_GET['nome'];

    // Procura titulos no banco relacionados ao valor
    $selectResult = $pdo->prepare ("SELECT cd_usuario,ic_status,nm_usuario,nm_email,ic_administrador  FROM tb_usuario WHERE nm_usuario LIKE '%".$nameUser."%'");
    $selectResult->execute();

//    var_dump($results);
//    exit;
?>
    <!--Exibe todos os valores encontrados-->
    <table class="table" id="inboxTable">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody class="table">
            <?php while ($results = $selectResult->fetch(PDO::FETCH_ASSOC)){
                if ($results['ic_status'] == 1) {$status = "Ativo"; $statusLabel = "label-success";} else {$status = "Suspenso"; $statusLabel = "label-danger";}
                if($results['ic_administrador'] == 1){$statusAdm = "checked";} else {$statusAdm = "null";}
                $cdUser = $results['cd_usuario'];
            ?>
                <tr>
                    <td><?php echo $results["nm_usuario"]; ?></td>
                    <td><?php echo $results["nm_email"]; ?></td>
                    <td><span class="label <?php echo $statusLabel;?>" style="padding: 8px 14px; cursor: default; "><?php echo $status;?></span></td>
                    <td style="margin: 0; padding:0;">
                        <div class="btn group mb5" style="padding: 6px 12px 6px 0;">
                                <a href="#" class="btn btn-sm btn-red mb5" style="margin-right:5px;" onclick="delUserAdmin('<?php echo $cdUser;?>')"><span class="icon-trash"></span> Deletar</a>
                                <a href="#" class="btn btn-sm btn-yellow mb5" style="margin-right:1px;"><span class="icon-key"></span> Resetar</a>
                            </div>
                        <div class="checkbox switch" style="margin:8px 0 0 0 ; float: left; padding: 0; height: 38px;  width: 70px;">
                            <label>
                                <input name="checkboxAdmin" id="checkboxAdmin" type="checkbox" style="margin:0; padding: 0; height: 38px;  width: 70px; " onclick="cbAdmin('<?php echo $cdUser;?>','<?php echo $statusAdm;?>')" <?php echo ($statusAdm);?>/>
                                <span class="cs-place"><span class="fa fa-check cs-handler"></span></span>
                            </label>
                        </div>
                    </td>
                </tr>
            <?php }; ?>
        </tbody>
    </table>