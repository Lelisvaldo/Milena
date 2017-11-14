<?php ini_set('default_charset','UTF-8');
    include "../conn.php";

    if(!isset($_SESSION)){session_start();}
//    if($_SERVER["REQUEST_URI"] != "/views/formPaineIndexlAdm.php") { header('location:../index.php');}
    if( (!isset ($_SESSION['email'])== true) || (!isset ($_SESSION['password']) == true) || ($_SESSION['admin'] == 0) ) {
        session_destroy();header('location:../views/formLogin.php');
    }
    $selectIcon = $pdo->prepare("SELECT * FROM tb_glyphicon");
    $selectIcon->execute();
    $icones = $selectIcon->fetchAll(PDO::FETCH_ASSOC);

    $selectDefaultPerfil = $pdo->prepare("SELECT tb_perfil_index.cd_perfil FROM tb_perfil_index WHERE tb_perfil_index.cd_perfil_index_ativo = 1");
    $selectDefaultPerfil->execute();
    $defaultPerfil = $selectDefaultPerfil->fetch(PDO::FETCH_ASSOC);
	
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
      <link rel="shortcut icon" href="../img/icon/Incon.ico">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

<body class="notransition">

    <!-- Header -->
    <header id="header">
        <input id="defaultcdperfil" type="hidden" name="country" value="<?php echo $defaultPerfil["cd_perfil"]; ?>">
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
                    <li><a href="dashboard.php"><span class="fa fa-dashboard"></span>Painel</a></li>
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
                <li><a href="dashboard.php"><span class="navIcon fa fa-dashboard"></span><span class="navLabel">Painel</span></a></li>
                <li class="hasSub">
                    <a href="#"><span class="navIcon icon-link"></span><span class="navLabel">Paginas</span><span class="fa fa-angle-left arrowRight"></span></a>
                    <ul>
                        <li><a href="formPaineListUser.php">Lista de Usuários</a></li>
                        <li><a href="formPainelUserAdm.php">Usuário</a></li>
                        <li><a href="formPainelAgendamentoAdm.php">Agenda</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="leftUserWraper dropup">
            <a href="#" class="avatarAction dropdown-toggle" data-toggle="dropdown">
                <img class="avatar" alt="avatar" src="<?php echo "../img/user/".@$_SESSION['imgUser'];?>">
                <div class="userBottom pull-left">
                    <span class="bottomUserName"><?php echo  $nome_separado[0]." ".$nome_separado[count($nome_separado)-1];?></span> <span class="fa fa-angle-up pull-right arrowUp"></span>
                </div>
                <div class="clearfix"></div>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="formPainelUserAdm.php"><span class="icon-user"></span>Usuário</a></li>
                <li><a href="dashboard.php"><span class="fa fa-dashboard"></span>Painel</a></li>
                <li class="divider"></li>
                <li><a href="../logout.php"><span class="icon-power"></span>Sair</a></li>
            </ul>
        </div>
    </div>
    <div class="closeLeftSide"></div>

    <!-- Content -->
    <form class="form-horizontal" method="POST" action="../formViewsDB/formPainelCRUD.php" role="form">
        <div id="wrapper" class="full">
            <div id="content" class="max">
                <div class="tables">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Perfil</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Perfil Inicial</label>
                                        <div class="col-sm-10">
                                            <select id="perfil" name="perfil" class="form-control">
                                                <option value="1">PERFIL 1</option>
                                                <option value="2">PERFIL 2</option>
                                                <option value="3">PERFIL 3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-default dd">
                                <a href="#ddPanelTitulo" class="btn btn-o btn-default btn-block btn-green align-left" data-toggle="collapse">Título<span class="fa fa-angle-down pull-right"></span></a>
                                <div id="ddPanelTitulo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="panel-body">
                                            <!---TITULO-->
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Título Inicial</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="tituloHeader" name="tituloHeader" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Subtítulo Inicial</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="subTituloHeader" name="subTituloHeader" class="form-control" value="">
                                                </div>
                                            </div>
                                            <!---FIM TITULO-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-default dd">
                                <a href="#ddPanelServico" class="btn btn-o btn-default btn-block btn-green align-left" data-toggle="collapse">Serviço<span class="fa fa-angle-down pull-right"></span></a>
                                <div id="ddPanelServico" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Subtítulo do Serviço</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="subTituloServico" name="subTituloServico" class="form-control" value="">
                                            </div>
                                        </div>
                                        <!---SERVIÇO 1-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Icone</label>
                                            <div class="col-sm-10">
                                                <select name="icoSevico1" id="icoSevico1" class="form-control">
                                                    <?php foreach ($icones as $key => $value ) { ?>
                                                        <option value="<?php echo $value["cd_icon"]; ?>">
                                                            <?php echo $value["nm_icone"]; ?>
                                                        </option>
                                                    <?php } ?>
                                                    <select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Serviço 1</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="tituloServico1" name="tituloServico1" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Descrição do Serviço</label>
                                            <div class="col-sm-10">
                                                <textarea id="descServico1" name="descServico1" class="form-control" rows="2"></textarea>
                                            </div>
                                        </div>
                                        <!---FIM SERVIÇO 1-->
                                        <!--SERVIÇO 2-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Icone</label>
                                            <div class="col-sm-10">
                                                <select name="icoSevico2" id="icoSevico2" class="form-control">
                                                    <?php foreach ($icones as $key => $value ) { ?>
                                                        <option value="<?php echo $value["cd_icon"]; ?>">
                                                            <?php echo $value["nm_icone"]; ?>
                                                        </option>
                                                    <?php } ?>
                                                    <select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Serviço 2</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="tituloServico2" name="tituloServico2" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Descrição do Serviço</label>
                                            <div class="col-sm-10">
                                                <textarea id="descServico2" name="descServico2" class="form-control" rows="2"></textarea>
                                            </div>
                                        </div>
                                        <!---FIM SERVIÇO 2-->
                                        <!--SERVIÇO 3-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Icone</label>
                                            <div class="col-sm-10">
                                                <select name="icoSevico3" id="icoSevico3" class="form-control">
                                                    <?php foreach ($icones as $key => $value ) { ?>
                                                        <option value="<?php echo $value["cd_icon"]; ?>">
                                                            <?php echo $value["nm_icone"]; ?>
                                                        </option>
                                                    <?php } ?>
                                                    <select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Serviço 3</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="tituloServico3" name="tituloServico3" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Descrição do Serviço</label>
                                            <div class="col-sm-10">
                                                <textarea id="descServico3" name="descServico3" class="form-control" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <!---FIM SERVIÇO 3-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-default dd">
                                <a href="#ddPanelSobre" class="btn btn-o btn-default btn-block btn-green align-left" data-toggle="collapse">Sobre<span class="fa fa-angle-down pull-right"></span></a>
                                <div id="ddPanelSobre" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <!---SOBRE-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Subtítulo Sobre</label>
                                            <div class="col-sm-10">
                                              <input type="text" id="subTituloSobre" name="subTituloSobre" class="form-control">
                                            </div>
                                          </div>
                                        <!--SOBRE 1-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Data Sobre 1</label>
                                            <div class="col-sm-10">
                                              <input type="text" id="dataSobre1" name="dataSobre1" class="form-control">
                                            </div>
                                          </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Titulo Sobre 1</label>
                                            <div class="col-sm-10">
                                              <input type="text" id="tituloSobre1" name="tituloSobre1" class="form-control">
                                            </div>
                                          </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Descrição Sobre 1</label>
                                            <div class="col-sm-10">
                                              <textarea class="form-control" id="descSobre1" name="descSobre1" rows="2"></textarea>
                                            </div>
                                          </div>
                                        <!--FIM SOBRE 1-->
                                        <!--SOBRE 2-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Data Sobre 2</label>
                                            <div class="col-sm-10">
                                              <input type="text" id="dataSobre2" name="dataSobre2" class="form-control">
                                            </div>
                                          </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Titulo Sobre 2</label>
                                            <div class="col-sm-10">
                                              <input type="text" id="tituloSobre2" name="tituloSobre2" class="form-control">
                                            </div>
                                          </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Descrição Depoimento 2</label>
                                            <div class="col-sm-10">
                                              <textarea class="form-control" id="descSobre2" name="descSobre2" rows="2"></textarea>
                                            </div>
                                          </div>
                                        <!--FIM SOBRE 2-->
                                        <!--SOBRE 3-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Data Sobre 3</label>
                                            <div class="col-sm-10">
                                              <input type="text" id="dataSobre3" name="dataSobre3" class="form-control">
                                            </div>
                                          </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Titulo Sobre 3</label>
                                            <div class="col-sm-10">
                                              <input type="text" id="tituloSobre3" name="tituloSobre3" class="form-control">
                                            </div>
                                          </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Descrição Sobre 3</label>
                                            <div class="col-sm-10">
                                              <textarea class="form-control" id="descSobre3" name="descSobre3" rows="2"></textarea>
                                            </div>
                                          </div>
                                        <!--FIM SOBRE 3-->
                                        <!--SOBRE 4-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Data Sobre 4</label>
                                            <div class="col-sm-10">
                                              <input type="text" id="dataSobre4" name="dataSobre4" class="form-control">
                                            </div>
                                          </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Titulo Sobre 4</label>
                                            <div class="col-sm-10">
                                              <input type="text" id="tituloSobre4" name="tituloSobre4" class="form-control">
                                            </div>
                                          </div>
                                        <div class="form-group">
                                                <label class="col-sm-2 control-label">Descrição Sobre 4</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" id="descSobre4" name="descSobre4" rows="2"></textarea>
                                                </div>
                                            </div>
                                        <!--FIM SOBRE 4-->
                                        <!---FIM SOBRE-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="Gravar" value="Gravar" class="btn btn-green" style="float: right;"><span class="fa fa-save state"></span> Salvar</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </form>


    <script src="../js/jquery-2.1.1.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/jquery-ui-touch-punch.js"></script>
    <script src="../js/jquery.placeholder.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.touchSwipe.min.js"></script>
    <script src="../js/jquery.slimscroll.min.js"></script>
    <script src="../js/jquery.visible.js"></script>
    <script src="../js/jquery.tagsinput.min.js"></script>
    <script src="../js/fileinput.min.js"></script>
    <script src="../js/app.js" type="text/javascript"></script>
    <script src="../js/jquery.blockUI.js" type="text/javascript"></script>
    <script>
        function carregarPerfil(id) {
            $.blockUI({
                message: '<h5>Carregando  <img src="../img/loading/loading.gif" /></h5>',
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                }
            });
            $.get("ajax/selectTextoIndex.php?cdperfil=" + id,
            function(header) {
                $('#tituloHeader').val(header.ds_titulo_header);
                $('#subTituloHeader').val(header.ds_sub_titulo_header);
                $('#subTituloServico').val(header.ds_sub_titulo_servico);
                $('#icoSevico1').val(header.cd_icone_servico_1);
                $('#tituloServico1').val(header.ds_titulo_servico_1);
                $('#descServico1').val(header.ds_servico_1);
                $('#icoSevico2').val(header.cd_icone_servico_2);
                $('#tituloServico2').val(header.ds_titulo_servico_2);
                $('#descServico2').val(header.ds_servico_2);
                $('#icoSevico3').val(header.cd_icone_servico_3);
                $('#tituloServico3').val(header.ds_titulo_servico_3);
                $('#descServico3').val(header.ds_servico_3);
                $('#subTituloSobre').val(header.ds_sub_titulo_sobre);
                $('#dataSobre1').val(header.dt_sobre_1);
                $('#tituloSobre1').val(header.ds_titulo_sobre_1);
                $('#descSobre1').val(header.ds_desc_sobre_1);
                $('#dataSobre2').val(header.dt_sobre_2);
                $('#tituloSobre2').val(header.ds_titulo_sobre_2);
                $('#descSobre2').val(header.ds_desc_sobre_2);
                $('#dataSobre3').val(header.dt_sobre_3);
                $('#tituloSobre3').val(header.ds_titulo_sobre_3);
                $('#descSobre3').val(header.ds_desc_sobre_3);
                $('#dataSobre4').val(header.dt_sobre_4);
                $('#tituloSobre4').val(header.ds_titulo_sobre_4);
                $('#descSobre4').val(header.ds_desc_sobre_4);
                setTimeout($.unblockUI, 380);
            });
        }
        $(document).ready(function() {
            $("#perfil").change(function() {
                carregarPerfil($(this).val());
            });
            $("#perfil").val($('#defaultcdperfil').val());
            carregarPerfil($('#defaultcdperfil').val());
        });
    </script>
</body>

</html>