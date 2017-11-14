<?php
//	ini_set('default_charset','UTF-ISO-8859-15');
    //session_start inicia a sessăo
    if(!isset($_SESSION)){session_start();}
    // Conexăo com o banco de dados
    include '../conn.php';
    include '../fbLogin/index.php';
    // Insere no banco os valores do userFb

    $sql = $pdo->prepare("SELECT cd_user_Id_Fb FROM tb_usuario WHERE cd_user_Id_Fb ='".$_SESSION ['userIdFb']."'");
    $sql->execute();
    $query_num_rows = $sql->rowCount();

//    var_dump($query_num_rows);
//    exit;

if ($query_num_rows > 0) {
//        echo "Este usuário já existe";
//        exit();
        header('location:../userSessionFb.php');
    }
    else{
        !$pdo->prepare
            ("
                  INSERT INTO
                    tb_usuario(
                      cd_user_Id_Fb,
                      nm_usuario,
                      im_usuario,
                      nm_email,
                      ic_administrador
                    )
                  VALUES (
                      '{$_SESSION ['userIdFb']}',
                      '{$_SESSION ['userNameFb']}',
                      '{$_SESSION ['userEmailFb']}',
                      '{$_SESSION ['userImageFb']}',
                      '0'
                  )
           ");
        $sql->execute();
        header('location:../userSessionFb.php');
//        echo "Dados inseridos com sucesso";
    }
