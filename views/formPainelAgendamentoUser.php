<?php ini_set('default_charset','UTF-8');
    include "../conn.php";

    if(!isset($_SESSION)){session_start();}
    //if($_SERVER["REQUEST_URI"] != "../index.php") { header('location:../index.php');}
    if( (!isset ($_SESSION['email'])== true) && (!isset ($_SESSION['password']) == true) && ($_SESSION['admin'] == 0) ) {
        session_destroy();header('location:../views/formLogin.php');
    }

    $selectServico = $pdo->prepare("SELECT tb_servico.cd_servico, tb_servico.nm_servico FROM tb_servico");
    $selectServico->execute();
    $option = $selectServico ->fetchAll(PDO::FETCH_ASSOC);
	
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
        <title>Painel Administraivo</title>
        <link href="../css/nanobar.css" rel="stylesheet">
        <link href="../css_Painel/font-awesome.css" rel="stylesheet">
        <link href="../css_Painel/simple-line-icons.css" rel="stylesheet">
        <link href="../css_Painel/jquery-ui.css" rel="stylesheet">
        <link href="../css_Painel/jquery.tagsinput.css" rel="stylesheet">
        <link href="../css_Painel/fileinput.min.css" rel="stylesheet">
        <link href="../css_Painel/app.css" rel="stylesheet">
        <link href="../css_Painel/bootstrap.css" rel="stylesheet">
        <!--DATE-->
        <link href="../css_Painel/bootstrap-datetimepicker.min.css" rel="stylesheet">

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
                    <li><a href="formPainelUserFb.php"><span class="icon-user"></span>Usuário</a></li>
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
                    <a href="formPainelUserFb.php"><span class="navIcon icon-user"></span><span class="navLabel">Usuário</span></a>
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
                <li><a href="formPainelUserFb.php"><span class="icon-user"></span>Usuário</a></li>
                <li class="divider"></li>
                <li><a href="../logout.php"><span class="icon-power"></span>Sair</a></li>
            </ul>
        </div>
    </div>
    <div class="closeLeftSide"></div>

    <!-- Content -->
    <div class="form-horizontal">
        <div id="wrapper" class="full">
            <div id="content" class="max">
                <div class="tables">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Agendamento</div>
                                <div class="panel-body">
                                    <!---SERVIÇO-->
                                    <div class="col-sm-3">
                                        <select id="idServico" name="idServico" class="form-control">
                                            <option>Escolha um Serviço</option>
                                            <?php foreach ($option as $key => $value ) { ?>
                                                <option value="<?php echo $value["cd_servico"];?>">
                                                    <?php echo $value["nm_servico"]; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <!--DATE-->
                                    <div class="form-control-static">
                                        <div class="col-md-6">
                                            <div id="datetimepicker"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <strong>Descrição do Serviço</strong>
                                            <p>
                                                <p>Data do Agendamento :</p>
                                                <p>Horário Inicial do Agendamento :</p>
                                                <p>Horário Final do Agendamento :</p>
                                                <p>Valor Aproximado do Serviço : R$</p>
                                            </p>
                                        </div>
                                    </div>
                                    <button type="submit" onclick="agendar();" id="Gravar" name="Gravar" value="Gravar" class="btn btn-green" style="float: right;">Agendar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <script src="../js/jquery-2.1.1.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/jquery-ui-touch-punch.js"></script>
    <script src="../js/jquery.placeholder.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.touchSwipe.min.js"></script>
    <script src="../js/jquery.slimscroll.min.js"></script>
    <script src="../js/jquery.visible.js"></script>
    <script src="../js/jquery.tagsinput.min.js"></script>
    <script src="../js/fileinput.min.js"></script>
    <script src="../js/app.js" type="text/javascript"></script>
    <script src="../js/jquery.blockUI.js" type="text/javascript"></script>
    <script src="../js/min/nanobar.min.js"></script>

    <!--DATE-->
    <script src="../js/min/moment.min.js"></script>
    <script src="../js/min/moment.pt-br.js"></script>
    <script src="../js/min/bootstrap-datetimepicker.min.js"></script>


    <script type="text/javascript">
        var datepicker = null;
        var idServico = document.getElementById('idServico');

        $(document).ready( function(){
            datepicker =    $('#datetimepicker').datetimepicker({
                locale: 'pt-BR',
                minDate: new Date(),
                inline: true,
                sideBySide: true,
                //daysOfWeekDisabled:[0,6]
                disabledDates: ['2017-06-03', '2017-06-04']
            });
        });

        function agendar(){
            $.post( "../formViewsDB/agendarUser.php", {
                cboServico: idServico.selectedIndex,
                dT: datepicker.data().DateTimePicker.date().format('YYYY-MM-DD HH:mm')
            });
        };
        $('#Gravar').click(function () {
            var nanobar = new Nanobar();
            // move bar
            nanobar.go( 30 ); // size bar 30%
            nanobar.go( 76 ); // size bar 76%
            // size bar 100% and and finish
            nanobar.go(100);
            alert('Agendamento enviado com sucesso!');
        });
    </script>
</body>

</html>