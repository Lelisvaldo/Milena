<?php
    //session_start
    if(!isset($_SESSION)){session_start();}
    // Conexao com o banco de dados
    include "../conn.php";
    include "../encrypt/encrypt.php";

    // Recupera os dados dos campos
    $nome = $_POST['nameUser'];
    $cpfCnpj = $_POST['textCpfCnpj'];

    //Define IcTipo de Usuario
    $contDigitos = strlen($cpfCnpj);
    if(($contDigitos > 0) || ($contDigitos <= 14)){$tipoUsuario = 1;}elseif(($contDigitos > 14) || ($contDigitos <= 18)){$tipoUsuario = 0;}


    $telCelular1 = $_POST['telCelular1'];
    $checkboxWhatsCel1 = isset($_POST['checkboxWhatsCel1']) ? 1 : 0;
    $telCelular2 = $_POST['telCelular2'];
    $checkboxWhatsCel2 = isset($_POST['checkboxWhatsCel2']) ? 1 : 0;
    $telCelular3 = $_POST['telCelular3'];
    $checkboxWhatsCel3 = isset($_POST['checkboxWhatsCel3']) ? 1 : 0;
    $telFixo = $_POST['telFixo'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numeroEndereco = $_POST['numeroEndereco'];
    $complemento = $_POST['complemento'];
    $pRef = $_POST['pRef'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $ibge = $_POST['ibge'];
    $uf = $_POST['uf'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $checkboxAdmin = isset($_POST['checkboxAdmin']) ? 1 : 0;

    //Verificaando a Imagem
    if (($_FILES['imgUser'] ['name'] == '') || ($_FILES['imgUser'] ['size'] == 0)){$nome_imagem = $_SESSION ['imgUser'];}
    elseif(($_SESSION ['imgUser'])!=($_FILES['imgUser'] ['name'])){
        $foto = $_FILES['imgUser'];
        // Se a foto estiver  selecionada
        if (!empty($foto["name"])) {
            // Se não houver nenhum erro
            if(!preg_match("/^image\/(jpeg|jpeg|png|gif|bmp)$/", $foto["type"])){$error[1] = "Isso não e uma imagem.";}
            // Pega extensão da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
            // Gera um nome único para a imagem
            $nome_imagem = md5(uniqid(time())).".".$ext[1];
            // Caminho de onde ficar a imagem
            $caminho_imagem = "../img/user/".$nome_imagem;
            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto["tmp_name"], $caminho_imagem);
            // Apaga a imagem
            if(!empty($_SESSION['imgUser'])){
                unlink("../img/user/".$_SESSION ['imgUser']."");
            }
        }
    }
    else{$nome_imagem = $_SESSION ['imgUser'];}

    //Verificaando a Senha
    if($password == null){$enc = $_SESSION['password'];    }
    else{$imputKey = "encryptor key"; $blockSize = 256; $aes = new AES($password, $imputKey, $blockSize); $enc = $aes->encrypt();}

    //Verifica se Usuario ja existe no banco
    $selectUser = $pdo->prepare ("SELECT cd_usuario, cd_cpf_cnpj FROM tb_usuario WHERE cd_usuario = '".$_SESSION ['idUser']."'");
    $selectUser->execute();
    $query_num_rowsSelecteUser = $selectUser->rowCount();
    $resultUser = $selectUser->fetch(PDO::FETCH_ASSOC);

//        var_dump($resultUser);
//        echo "<br><br>";

    //Verifica se CEP ja existe no banco e Atualiza o BAIRRO
    $selectCep = $pdo->prepare("SELECT tb_endereco.cd_cep FROM tb_endereco WHERE tb_endereco.cd_cep ='".$cep."';");
    $selectCep->execute();
    $query_num_rowsSelectCep = $selectCep->rowCount();
    $resultCep = $selectCep->fetch(PDO::FETCH_ASSOC);

//        var_dump($query_num_rowsSelectCep);
//        var_dump($resultCep);
//        echo "<br><br>";

    //Verifica se BAIRRO ja existe no banco
    $selectBairro = $pdo->prepare("SELECT tb_bairro.cd_bairro FROM tb_bairro WHERE tb_bairro.nm_bairro ='".$bairro."';");
    $selectBairro->execute();
    $query_num_rowsSelectBairro = $selectBairro->rowCount();
    $resultBairro = $selectBairro->fetch(PDO::FETCH_ASSOC);

//        var_dump($query_num_rowsSelectBairro);
//        var_dump($resultBairro);
//        echo "<br><br>";

    //Verifica se CIDADE ja existe no banco
    $selectCidade = $pdo->prepare("SELECT tb_cidade.cd_cidade FROM tb_cidade WHERE tb_cidade.cd_ibge ='".$ibge."';");
    $selectCidade->execute();
    $query_num_rowsSelectCidade = $selectCidade->rowCount();
    $resultCidade = $selectCidade->fetch(PDO::FETCH_ASSOC);

//        var_dump($query_num_rowsSelectCidade);
//        var_dump($resultCidade);
//        echo "<br><br>";

    //Verifica se UF ja existe no banco
    $selectUf = $pdo->prepare("SELECT tb_uf.cd_uf FROM tb_uf WHERE tb_uf.nm_uf ='".$uf."';");
    $selectUf->execute();
    $query_num_rowsSelectUf = $selectUf->rowCount();
    $resultUf = $selectUf->fetch(PDO::FETCH_ASSOC);

//        var_dump($query_num_rowsSelectUf);
//        var_dump($resultUf);
//        echo "<br><br>";

    // SE CEP/BAIRRO/CIADADE/UF NAO EXISTIR
    if (($query_num_rowsSelectCep ==0) || ($query_num_rowsSelectBairro ==0) || ($query_num_rowsSelectCidade == 0) || ($query_num_rowsSelectUf == 0)){
        //    Insere os dados no banco
        if(($_SESSION['idUser'] == $resultUser['cd_usuario']) || ($cpfCnpj == $resultUser['cd_cpf_cnpj'])){
            if ($query_num_rowsSelectUf == 0){
                $insertUf = $pdo->prepare ("INSERT INTO tb_uf (cd_uf, nm_uf) VALUES (DEFAULT, '".$uf."');");
                $insertUf->execute();
                $lastIdUf = $pdo->lastInsertId("tb_uf");
            }
            if($query_num_rowsSelectCidade == 0){
                $insertCidade = $pdo->prepare ("INSERT INTO tb_cidade (cd_cidade, nm_cidade, cd_ibge, cd_uf) VALUES (DEFAULT, '".$cidade."', '".$ibge."', '".$lastIdUf."');");
                $insertCidade->execute();
                $lastIdCidade = $pdo->lastInsertId("tb_cidade");
            }
            if($query_num_rowsSelectBairro == 0){
                $insertBairro = $pdo->prepare (" INSERT INTO tb_bairro(cd_bairro, nm_bairro, cd_cidade) VALUES (DEFAULT,'".$bairro."', '".$lastIdCidade."');");
                $insertBairro->execute();
                $lastIdBairro = $pdo->lastInsertId("tb_bairro");
                $updateEndCDBAIRRO = $pdo->prepare("UPDATE tb_endereco SET cd_bairro ='".$lastIdBairro."' WHERE tb_endereco.cd_endereco = '".$_SESSION["idUser"]."'");
                $updateEndCDBAIRRO->execute();
            }
            $crud = $pdo->prepare("
            CALL sp_updateUser(
            '".$_SESSION['idUser']."',
            '".$cpfCnpj."',
            '".$nome."',
            '".$nome_imagem."',
            '".$email."',
            '".$enc."',
            '".$checkboxAdmin."',
            '".$tipoUsuario."',
            '".$cep."',
            '".$rua."',
            '".$numeroEndereco."',
            '".$complemento."',
            '".$pRef."',
            '".$telFixo."',
            '".$telCelular1."',
            '".$checkboxWhatsCel1."',
            '".$telCelular2."',
            '".$checkboxWhatsCel2."',
            '".$telCelular3."',
            '".$checkboxWhatsCel3."'
            );
            ");
            $crud->execute();
        }
        session_destroy();
        header('location:../views/formLogin.php');
    }
    // SE CEP/BAIRRO/CIADADE NAO EXISTIR
    elseif (($query_num_rowsSelectCep ==0) || ($query_num_rowsSelectBairro ==0) || ($query_num_rowsSelectCidade == 0) || ($query_num_rowsSelectUf !=0 )){
        //    Insere os dados no banco
        if($_SESSION['idUser'] == $resultUser['cd_usuario']){
            if($query_num_rowsSelectCidade == 0){
                $insertCidade = $pdo->prepare ("INSERT INTO tb_cidade (cd_cidade, nm_cidade, cd_ibge, cd_uf) VALUES (DEFAULT, '".$cidade."', '".$ibge."', '".$resultUf["cd_uf"]."');");
                $insertCidade->execute();
                $lastIdCidade = $pdo->lastInsertId("tb_cidade");
            }
            if($query_num_rowsSelectBairro == 0){
                $insertBairro = $pdo->prepare (" INSERT INTO tb_bairro(cd_bairro, nm_bairro, cd_cidade) VALUES (DEFAULT,'".$bairro."', '".$lastIdCidade."');");
                $insertBairro->execute();
                $lastIdBairro = $pdo->lastInsertId("tb_bairro");
                $updateEndCDBAIRRO = $pdo->prepare("UPDATE tb_endereco SET cd_bairro ='".$lastIdBairro."' WHERE tb_endereco.cd_endereco = '".$_SESSION["idUser"]."'");
                $updateEndCDBAIRRO->execute();
            }
            $crud = $pdo->prepare("
            CALL sp_updateUser(
            '".$_SESSION['idUser']."',
            '".$cpfCnpj."',
            '".$nome."',
            '".$nome_imagem."',
            '".$email."',
            '".$enc."',
            '".$checkboxAdmin."',
            '".$tipoUsuario."',
            '".$cep."',
            '".$rua."',
            '".$numeroEndereco."',
            '".$complemento."',
            '".$pRef."',
            '".$telFixo."',
            '".$telCelular1."',
            '".$checkboxWhatsCel1."',
            '".$telCelular2."',
            '".$checkboxWhatsCel2."',
            '".$telCelular3."',
            '".$checkboxWhatsCel3."'
            );
            ");
            $crud->execute();
        }
        session_destroy();
        header('location:../views/formLogin.php');
    }
    // SE CEP/BAIRRO NAO EXISTIR
    elseif (($query_num_rowsSelectCep ==0) || ($query_num_rowsSelectBairro ==0) || ($query_num_rowsSelectCidade != 0) || ($query_num_rowsSelectUf !=0 )){
        //    Insere os dados no banco
        if($_SESSION['idUser'] == $resultUser['cd_usuario']) {
            if ($query_num_rowsSelectBairro == 0) {
                $insertBairro = $pdo->prepare(" INSERT INTO tb_bairro(cd_bairro, nm_bairro, cd_cidade) VALUES (DEFAULT,'" . $bairro . "', '" . $resultCidade ["cd_cidade"] . "');");
                $insertBairro->execute();
                $lastIdBairro = $pdo->lastInsertId("tb_bairro");
                $updateEndCDBAIRRO = $pdo->prepare("UPDATE tb_endereco SET cd_bairro ='" . $lastIdBairro . "' WHERE tb_endereco.cd_endereco = '" . $_SESSION["idUser"] . "'");
                $updateEndCDBAIRRO->execute();
            }
            $crud = $pdo->prepare("
            CALL sp_updateUser(
            '" . $_SESSION['idUser'] . "',
            '" . $cpfCnpj . "',
            '" . $nome . "',
            '" . $nome_imagem . "',
            '" . $email . "',
            '" . $enc . "',
            '" . $checkboxAdmin . "',
            '" . $tipoUsuario . "',
            '" . $cep . "',
            '" . $rua . "',
            '" . $numeroEndereco . "',
            '" . $complemento . "',
            '" . $pRef . "',
            '" . $telFixo . "',
            '" . $telCelular1 . "',
            '" . $checkboxWhatsCel1 . "',
            '" . $telCelular2 . "',
            '" . $checkboxWhatsCel2 . "',
            '" . $telCelular3 . "',
            '" . $checkboxWhatsCel3 . "'
            );
            ");
            $crud->execute();
        }
        session_destroy();
        header('location:../views/formLogin.php');
    }
    //SE CEP EXIXTIR
    elseif (($query_num_rowsSelectCep ==0) || ($query_num_rowsSelectBairro !=0) || ($query_num_rowsSelectCidade != 0) || ($query_num_rowsSelectUf != 0)){
//        echo "Entrou no ELSEIF NÃO TEM CEP cadastrado";
        //    Insere os dados no banco
        if($_SESSION['idUser'] == $resultUser['cd_usuario']) {
            $updateEndCDBAIRRO = $pdo->prepare("UPDATE tb_endereco SET tb_endereco.cd_bairro ='" . $resultBairro ["cd_bairro"] . "' WHERE tb_endereco.cd_endereco = '" . $_SESSION["idUser"] . "'");
            $updateEndCDBAIRRO->execute();
            $crud = $pdo->prepare("
            CALL sp_updateUser(
            '" . $_SESSION['idUser'] . "',
            '" . $cpfCnpj . "',
            '" . $nome . "',
            '" . $nome_imagem . "',
            '" . $email . "',
            '" . $enc . "',
            '" . $checkboxAdmin . "',
            '" . $tipoUsuario . "',
            '" . $cep . "',
            '" . $rua . "',
            '" . $numeroEndereco . "',
            '" . $complemento . "',
            '" . $pRef . "',
            '" . $telFixo . "',
            '" . $telCelular1 . "',
            '" . $checkboxWhatsCel1 . "',
            '" . $telCelular2 . "',
            '" . $checkboxWhatsCel2 . "',
            '" . $telCelular3 . "',
            '" . $checkboxWhatsCel3 . "'
            );
            ");
            $crud->execute();
        }
        session_destroy();
        header('location:../views/formLogin.php');
    }
    //SE CEP EXIXTIR
    else{
//        echo "</br> Entrou no else";
        //    Insere os dados no banco
        if($_SESSION['idUser'] == $resultUser['cd_usuario']) {
            $updateEndCDBAIRRO = $pdo->prepare("UPDATE tb_endereco SET tb_endereco.cd_bairro ='" . $resultBairro ["cd_bairro"] . "' WHERE tb_endereco.cd_endereco = '" . $_SESSION["idUser"] . "'");
            $updateEndCDBAIRRO->execute();

            $crud = $pdo->prepare("
            CALL sp_updateUser(
            '" . $_SESSION['idUser'] . "',
            '" . $cpfCnpj . "',
            '" . $nome . "',
            '" . $nome_imagem . "',
            '" . $email . "',
            '" . $enc . "',
            '" . $checkboxAdmin . "',
            '" . $tipoUsuario . "',
            '" . $cep . "',
            '" . $rua . "',
            '" . $numeroEndereco . "',
            '" . $complemento . "',
            '" . $pRef . "',
            '" . $telFixo . "',
            '" . $telCelular1 . "',
            '" . $checkboxWhatsCel1 . "',
            '" . $telCelular2 . "',
            '" . $checkboxWhatsCel2 . "',
            '" . $telCelular3 . "',
            '" . $checkboxWhatsCel3 . "'
            );
            ");
            $crud->execute();
        }
        session_destroy();
        header('location:../views/formLogin.php');
    }