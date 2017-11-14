
<?php
	ini_set('default_charset','UTF-ISO-8859-15');
    //session_start inicia a sessão
    if(!isset($_SESSION)){session_start();}
    // Conexão com o banco de dados
    include "../conn.php";

    // busca em banco os valores do telefones
    $selectResult = $pdo->prepare ("
                                    SELECT
                                        tb_usuario.cd_usuario,
                                        tb_usuario.nm_usuario,
                                        tb_usuario.cd_cpf_cnpj,
                                        tb_usuario.im_usuario,
                                        tb_usuario.ic_tipo_usuario,
                                        tb_endereco.cd_cep,
                                        tb_endereco.ds_endereco,
                                        tb_endereco.cd_numero_endereco,
                                        tb_endereco.ds_complemento,
                                        tb_endereco.ds_ponto_referencia,
                                        tb_telefone.cd_fixo,
                                        tb_telefone.cd_celular1,
                                        tb_telefone.ic_whatsapp1,
                                        tb_telefone.cd_celular2,
                                        tb_telefone.ic_whatsapp2,
                                        tb_telefone.cd_celular3,
                                        tb_telefone.ic_whatsapp3
                                    FROM tb_usuario
                                    INNER JOIN tb_telefone
                                        ON tb_usuario.cd_telefone = tb_telefone.cd_telefone
                                    INNER JOIN tb_endereco
                                        ON tb_usuario.cd_endereco = tb_endereco.cd_endereco
                                    WHERE tb_usuario.cd_usuario ='".$_SESSION['idUser']."'
    ");
    $selectResult->execute();
    $result = $selectResult->fetch(PDO::FETCH_ASSOC);

    //Definindo Session Usuario
    $_SESSION['nameUser'] = $result["nm_usuario"];
    $_SESSION['cpfCnpj'] = $result["cd_cpf_cnpj"];
    $_SESSION['imgUser'] = $result["im_usuario"];
    $_SESSION['icTipoUser'] = $result["ic_tipo_usuario"];
    $_SESSION['cep'] = $result["cd_cep"];
    $_SESSION['rua'] = $result["ds_endereco"];
    $_SESSION['numeroEndereco'] = $result["cd_numero_endereco"];
    $_SESSION['complemento'] = $result["ds_complemento"];
    $_SESSION['pRef'] = $result["ds_ponto_referencia"];
    $_SESSION['telFixo'] = $result["cd_fixo"];
    $_SESSION['telCelular1'] = $result["cd_celular1"];
    $_SESSION['WhatsCel1'] = $result["ic_whatsapp1"];
    $_SESSION['telCelular2'] = $result["cd_celular2"];
    $_SESSION['WhatsCel2'] = $result["ic_whatsapp2"];
    $_SESSION['telCelular3'] = $result["cd_celular3"];
    $_SESSION['WhatsCel3'] = $result["ic_whatsapp3"];

        // Busca no banco os valores de Endereco
        $selectResultEND = $pdo->prepare ("
                                    SELECT
                                        tb_bairro.nm_bairro,
                                        tb_cidade.nm_cidade,
                                        tb_cidade.cd_ibge,
                                        tb_uf.nm_uf
                                    FROM tb_usuario
                                    INNER JOIN tb_endereco
                                        ON tb_usuario.cd_endereco = tb_endereco.cd_endereco
                                    INNER JOIN tb_bairro
                                        ON tb_endereco.cd_bairro = tb_bairro.cd_bairro
                                    INNER JOIN tb_cidade
                                        ON tb_bairro.cd_cidade = tb_cidade.cd_cidade
                                    INNER JOIN tb_uf
                                        ON tb_cidade.cd_uf = tb_uf.cd_uf
                                    WHERE tb_usuario.cd_usuario ='".$_SESSION['idUser']."'
    ");
    $selectResultEND->execute();
    $query_num_rowsEND = $selectResultEND->rowCount();
    $resultEND = $selectResultEND->fetch(PDO::FETCH_ASSOC);

    if($query_num_rowsEND != 0){
        //Definindo Session Usuario
        $_SESSION['bairro'] = $resultEND["nm_bairro"];
        $_SESSION['cidade'] = $resultEND["nm_cidade"];
        $_SESSION['cd_ibge'] = $resultEND["cd_ibge"];
        $_SESSION['uf'] = $resultEND["nm_uf"];
    }
    if( $_SESSION['admin'] == 0){header('location:../views/formPainelUserfb.php');}
    elseif($_SESSION['admin'] == 1){header('location:../views/dashboard.php');}