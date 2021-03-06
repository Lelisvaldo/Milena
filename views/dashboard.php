<?php ini_set('default_charset','UTF-8');
    include('../conn.php');
    if(!isset($_SESSION)){session_start();}
    if( (!isset ($_SESSION['email'])== true) || (!isset ($_SESSION['password']) == true) || ($_SESSION['admin'] == 0) ) {
        session_destroy();header('location:../views/formLogin.php');
    }

    $num_total = $pdo->prepare ("SELECT cd_agendamento FROM tb_agendamento");
    $num_total->execute();
    $ntAgendamentos = $num_total->rowCount();

    $num_total = $pdo->prepare ("SELECT cd_usuario FROM tb_usuario");
    $num_total->execute();
    $ntUsuarios = $num_total->rowCount();
	
	$nome = $_SESSION['nameUser']; //recebe a variavel que Possue o nome
	$nome_separado = explode(" ",$nome); //explode 
?>
<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-ISO-8859-1">
        <meta http-equiv="Content-Type" content="text/php; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>Painel Administrativo</title>
        <link href="../css_Painel/font-awesome.css" rel="stylesheet">
        <link href="../css_Painel/simple-line-icons.css" rel="stylesheet">
        <link href="../css_Painel/jquery-ui.css" rel="stylesheet">
        <link href="../css_Painel/jquery.tagsinput.css" rel="stylesheet">
        <link href="../css_Painel/fileinput.min.css" rel="stylesheet">
        <link href="../css_Painel/app.css" rel="stylesheet">
        <link href="../css_Painel/bootstrap.css" rel="stylesheet">
        <link href="../css_Painel/sb-admin.css" rel="stylesheet">
        <link rel="shortcut icon" href="../img/icon/Incon.ico">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

<body class="notransition">

        <!-- Header -->
        <header id="header">
            <div class="logo">
                <a href="../index.php">
                    <span class="fa fa-home marker"></span>
                    <span class="logoText">Início</span>
                </a>
            </div>
            <a href="#" class="navHandler"><span class="fa fa-bars"></span></a>
            <div class="headerUserWraper">
                <a href="#" class="userHandler dropdown-toggle" data-toggle="dropdown"><span class="icon-user"></span></a>
                <a href="#" class="headerUser dropdown-toggle" data-toggle="dropdown">
                    <img class='avatar mobAvatarImg' alt='avatar' style="width: 51px; height: 51px; float: left;" src="<?php echo "../img/user/".@$_SESSION['imgUser'];?>">
                    <div class="userTop pull-left">
                        <span class="headerUserName"><?php echo $_SESSION['nameUser'];?></span> <span class="fa fa-angle-down"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
                <div class="dropdown-menu pull-right userMenu" role="menu">
                    <div class="mobAvatar">
                        <img class='avatar mobAvatarImg' alt='avatar' src="<?php echo " ../img/user/".@$_SESSION['imgUser'];?>">
                        <div class="mobAvatarName"><?php echo  $nome_separado[0]." ".$nome_separado[count($nome_separado)-1];?></div>
                    </div>
                    <ul>
                        <li><a href="formPainelUserAdm.php"><span class="icon-user"></span>Usuário</a></li>
                        <li class="divider"></li>
                        <li><a href="../logout.php"><span class="icon-power"></span>Sair</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Left Side Navigation -->
        <div id="leftSide">
            <nav class="leftNav scrollable">
                <ul>
                    <li class="hasSub">
                        <a href="#"><span class="navIcon icon-link"></span><span class="navLabel">Paginas</span><span class="fa fa-angle-left arrowRight"></span></a>
                        <ul>
                            <li><a href="formPaineListUser.php">Lista de Usuários</a></li>
                            <li><a href="formPainelUserAdm.php">Usuário</a></li>
                            <li><a href="formPainelAgendamentoAdm.php">Agenda</a></li>
                            <li><a href="formPaineIndexlAdm.php">Configurar Perfil</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="leftUserWraper dropup">
                <a href="#" class="avatarAction dropdown-toggle" data-toggle="dropdown">
                    <img class="avatar" alt="avatar" src="<?php echo "../img/user/".@$_SESSION['imgUser'];?>">
                    <div class="userBottom pull-left">
					
                        <span class="bottomUserName"><?php echo  $nome_separado[0]."&nbsp;".$nome_separado[count($nome_separado)-1];?></span> <span class="fa fa-angle-up pull-right arrowUp"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="formPainelUserAdm.php"><span class="icon-user"></span>Usuário</a></li>
                    <li class="divider"></li>
                    <li><a href="../logout.php"><span class="icon-power"></span>Sair</a></li>
                </ul>
            </div>
        </div>
        <div class="closeLeftSide"></div>

        <!-- Content -->
        <div id="wrapper" class="full">
            <div id="content" class="max">
                <div id="content" class="max">
                    <div class="tables">
                        <h4>Painel de Controle</h4>
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa icon-globe fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div>Configurar Perfil</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="formPaineIndexlAdm.php">
                                        <div class="panel-footer">
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <span class="pull-right">Detalhes&nbsp;</span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-calendar fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div>Agendamentos</div>
                                                <div class="huge">Nº <?php echo $ntAgendamentos;?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="formPainelAgendamentoAdm.php">
                                        <div class="panel-footer">
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <span class="pull-right">Detalhes&nbsp;</span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-users fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div>Usuarios</div>
                                                <div class="huge">Nº <?php echo $ntUsuarios;?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="formPaineListUser.php">
                                        <div class="panel-footer">
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <span class="pull-right">Detalhes&nbsp;</span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <script src="../js/jquery-2.1.1.min.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <script src="../js/jquery-ui-touch-punch.js"></script>
        <script src="../js/jquery.placeholder.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/jquery.touchSwipe.min.js"></script>
        <script src="../js/jquery.slimscroll.min.js"></script>
        <script src="../js/jquery.visible.js"></script>
        <script src="../js/tablesorter.js"></script>
        <script src="../js/jquery.mjs.nestedSortable.js"></script>
        <script src="../js/jquery.tagsinput.min.js"></script>
        <script src="../js/app.js" type="text/javascript"></script>
        <script src="../js/table.js"></script>
        <script src="../js/sortable.js"></script>
</body>
</html>