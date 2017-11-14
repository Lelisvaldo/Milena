<?php ini_set('default_charset','UTF-8');
    // session_start inicia a sessão
    if(!isset($_SESSION)){session_start();}
    include "conn.php";
    include './encrypt/encrypt.php';
    $login = $_POST['username'];
    $password = $_POST['password'];

    $imputKey = "encryptor key";
    $blockSize = 256;
    $aes = new AES($password, $imputKey, $blockSize);
    $enc = $aes->encrypt();
    //    echo $enc;

    // A variavel $select pega as varias $login e $senha, faz uma pesquisa na tabela de usuario
    $selectLogin = $pdo->prepare ("SELECT cd_usuario, nm_email, ic_administrador
    FROM tb_usuario
    WHERE nm_email = :login
    AND ds_senha = :enc");
    $selectLogin->bindParam(':login', $login);
    $selectLogin->bindParam(':enc', $enc);
    $selectLogin->execute();
    $query_num_rows = $selectLogin->rowCount();
    $resultLogin = $selectLogin->fetch(PDO::FETCH_ASSOC);

    /*Definindo Session Login*/
    if(($query_num_rows != 0) || ($resultLogin["ic_administrador"] == 1)){
        $_SESSION['idUser'] = $resultLogin["cd_usuario"];
        $_SESSION['email'] = $resultLogin["nm_email"];
        $_SESSION['password'] = $enc;
        $_SESSION['admin'] = $resultLogin["ic_administrador"];
        header('location:../formViewsDB/selectUser.php');
    }
    elseif(($query_num_rows != 0) || ($resultLogin["ic_administrador"] == 0)){
        $_SESSION['idUser'] = $resultLogin["cd_usuario"];
        $_SESSION['email'] = $resultLogin["nm_email"];
        $_SESSION['password'] = $enc;
        $_SESSION['admin'] = $resultLogin["ic_administrador"];
        header('location:../formViewsDB/selectUser.php');
    }
    else{
        session_destroy();
        header('location:../views/formLogin.php');
    }