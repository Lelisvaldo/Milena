<?php if(!isset($_SESSION)){session_start();}

    if( (!isset ($_SESSION['email'])== true) || (!isset ($_SESSION['password']) == true) ) {
        if($_SERVER["REQUEST_URI"] != "../views/formLogin.php"){
            header('location:../views/formLogin.php');
        }
    }
    else{
        if($_SESSION['admin'] == 1){
            header('location:../views/formPaineIndexlAdm.php');
            exit;
        }
        else{
            header('location:../views/formPainelUserFb.php');
            exit;
        }

    }

