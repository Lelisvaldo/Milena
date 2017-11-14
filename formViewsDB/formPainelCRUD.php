<?php
    // Conexao com o banco de dados
    include "../conn.php";
    // Recupera os dados dos campos
    $perfil = $_POST['perfil'];
    $tituloHeader = $_POST['tituloHeader'];
    $subTituloHeader = $_POST['subTituloHeader'];
    $subTituloServico = $_POST['subTituloServico'];
    $icoSevico1 = $_POST['icoSevico1'];
    $tituloServico1 = $_POST['tituloServico1'];
    $descServico1 = $_POST['descServico1'];
    $icoSevico2 = $_POST['icoSevico2'];
    $tituloServico2 = $_POST['tituloServico2'];
    $descServico2 = $_POST['descServico2'];
    $icoSevico3 = $_POST['icoSevico3'];
    $tituloServico3 = $_POST['tituloServico3'];
    $descServico3 = $_POST['descServico3'];
    $subTituloSobre = $_POST['subTituloSobre'];
    $dataSobre1 = $_POST['dataSobre1'];
    $tituloSobre1 = $_POST['tituloSobre1'];
    $descSobre1 = $_POST['descSobre1'];
    $dataSobre2 = $_POST['dataSobre2'];
    $tituloSobre2 = $_POST['tituloSobre2'];
    $descSobre2 = $_POST['descSobre2'];
    $dataSobre3 = $_POST['dataSobre3'];
    $tituloSobre3 = $_POST['tituloSobre3'];
    $descSobre3 = $_POST['descSobre3'];
    $dataSobre4 = $_POST['dataSobre4'];
    $tituloSobre4 = $_POST['tituloSobre4'];
    $descSobre4 = $_POST['descSobre4'];

    $update = $pdo->prepare ("UPDATE tb_perfil_index SET cd_perfil_index_ativo = 0");
    $update->execute();

    if($perfil == "1"){
        $update = $pdo->prepare ("UPDATE tb_perfil_index SET cd_perfil_index_ativo = 1 WHERE cd_perfil = 1;");
        $update->execute();
    }
    elseif($perfil == "2"){
        $update = $pdo->prepare ("UPDATE tb_perfil_index SET cd_perfil_index_ativo = 1 WHERE cd_perfil = 2;");
        $update->execute();
    }
    elseif($perfil == "3"){
        $update = $pdo->prepare ("UPDATE tb_perfil_index SET cd_perfil_index_ativo = 1 WHERE cd_perfil = 3;");
        $update->execute();
    }
    //Atualiza os dados no banco
    $crud = $pdo->prepare("
        CALL sp_updateIndex(
                            '".$tituloHeader."',
                            '".$subTituloHeader."',
                            '".$subTituloServico."',
                            '".$icoSevico1."',
                            '".$tituloServico1."',
                            '".$descServico1."',
                            '".$icoSevico2."',
                            '".$tituloServico2."',
                            '".$descServico2."',
                            '".$icoSevico3."',
                            '".$tituloServico3."',
                            '".$descServico3."',
                            '".$subTituloSobre."',
                            '".$dataSobre1."',
                            '".$tituloSobre1."',
                            '".$descSobre1."',
                            '".$dataSobre2."',
                            '".$tituloSobre2."',
                            '".$descSobre2."',
                            '".$dataSobre3."',
                            '".$tituloSobre3."',
                            '".$descSobre3."',
                            '".$dataSobre4."',
                            '".$tituloSobre4."',
                            '" .$descSobre4."
        ');
    ");
    $crud->execute();
    header('location:../index.php');