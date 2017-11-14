<?php
    // session_start inicia a sesso
    if(!isset($_SESSION)){session_start();}
    include'./fbLogin/index.php';

        echo $_SESSION ['userNameFb'].'<br>';
        echo $_SESSION ['userIdFb'].'<br>';
        echo $_SESSION ['userEmailFb'].'<br>';
        echo "<img src=".$_SESSION ['userImageFb']." /><br><br>";

/*    // A variavel $select pega as varias $login e $senha, faz uma pesquisa na tabela de usuario
    $selectLogin = $pdo->prepare ("SELECT cd_usuario,cd_user_Id_Fb,nm_email,ic_administrador
                                   FROM tb_usuario
                                   WHERE cd_user_Id_Fb = '".$_SESSION ['userIdFb']."'
                                   AND nm_email = '".$_SESSION ['userEmailFb']."'");
    $selectLogin->execute();
    //$query_num_rows = $selectLogin->rowCount();
    $resultLogin = $selectLogin->fetch(PDO::FETCH_ASSOC);

    var_dump($resultLogin);
    exit;*/

    /*Definindo Session Login*/
/*    if( ($query_num_rows != 0) || ($resultLogin["ic_administrador"] == 1) ){
        $_SESSION['idUser'] = $resultLogin["cd_usuario"];
        $_SESSION['email'] = $resultLogin["nm_email"];
        $_SESSION['password'] = $resultLogin["ds_senha"];
        $_SESSION['administrador'] = $resultLogin["ic_administrador"];
        header('location:http://localhost/formViewsDB/selectUser.php');
    }
    else{
        session_destroy();
        header('location:../views/formLogin.php');
    }*/
