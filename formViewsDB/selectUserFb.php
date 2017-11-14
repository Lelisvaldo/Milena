<?php/*
	ini_set('default_charset','UTF-ISO-8859-15');
    //session_start inicia a sess�o
    if(!isset($_SESSION)){session_start();}
    // Conex�o com o banco de dados
    include "../conn.php";
    include "../userSessionFb.php";
    // busca em banco os valores do telefones
    $selectResult = $pdo->prepare ("
        SELECT  tb_usuario.cd_usuario,
                tb_usuario.cd_user_Id_Fb,
                tb_usuario.nm_usuario,
                tb_usuario.cd_cpfCnpj,
                tb_usuario.im_usuario,
                tb_usuario.ic_tipo_usuario,
                tb_endereco.cd_cep,
                tb_endereco.ds_endereco,
                tb_endereco.nm_bairro,
                tb_endereco.nm_cidade,
                tb_endereco.sg_uf,
                tb_endereco.numero_endereco,
                tb_endereco.ds_complemento,
                tb_endereco.cd_ibge,
                tb_regiao.nm_regiao,
                tb_regiao.vl_regiao,
                tb_telefone.cd_fixo,
                tb_telefone.cd_celular1,
                tb_telefone.ic_whatsapp1,
                tb_telefone.cd_celular2,
                tb_telefone.ic_whatsapp2,
                tb_telefone.cd_celular3,
                tb_telefone.ic_whatsapp3
        FROM tb_usuario
        LEFT JOIN tb_endereco ON tb_usuario.cd_endereco = tb_endereco.cd_endereco
        LEFT JOIN tb_telefone ON tb_usuario.cd_telefone = tb_telefone.cd_telefone
        LEFT JOIN tb_regiao ON tb_endereco.cd_regiao = tb_regiao.cd_regiao
        WHERE cd_usuario = '".$_SESSION['idUser']."'AND tb_usuario.cd_user_Id_Fb ='".$_SESSION ['userIdFb']."'"
    );
    $selectResult->execute();
    $query_num_rows = $selectResult->rowCount();
    $result = $selectResult->fetch(PDO::FETCH_ASSOC);

//    var_dump($result);
//    exit;

    Definindo Session Usuario
    $_SESSION['nameUser'] = $result["nm_usuario"];
    $_SESSION['cpfCnpj'] = $result["cd_cpfCnpj"];
    $_SESSION['imgUser'] = $result["im_usuario"];
    $_SESSION['icTipoUser'] = $result["ic_tipo_usuario"];
    $_SESSION['cep'] = $result["cd_cep"];
    $_SESSION['endereco'] = $result["ds_endereco"];
    $_SESSION['bairro'] = $result["nm_bairro"];
    $_SESSION['cidade'] = $result["nm_cidade"];
    $_SESSION['uf'] = $result["sg_uf"];
    $_SESSION['numeroEndereco'] = $result["numero_endereco"];
    $_SESSION['complemento'] = $result["ds_complemento"];
    $_SESSION['cd_ibge'] = $result["cd_ibge"];
    $_SESSION['regiao'] = $result["nm_regiao"];
    $_SESSION['vlRegiao'] = $result["vl_regiao"];
    $_SESSION['telFixo'] = $result["cd_fixo"];
    $_SESSION['telCelular1'] = $result["cd_celular1"];
    $_SESSION['WhatsCel1'] = $result["ic_whatsapp1"];
    $_SESSION['telCelular2'] = $result["cd_celular2"];
    $_SESSION['WhatsCel2'] = $result["ic_whatsapp2"];
    $_SESSION['telCelular3'] = $result["cd_celular3"];
    $_SESSION['WhatsCel3'] = $result["ic_whatsapp3"];

    header('location:../views/formPainelUserFb.php');*/