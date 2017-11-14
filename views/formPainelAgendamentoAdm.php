<?php ini_set('default_charset','UTF-8');
    include "../conn.php";

    if(!isset($_SESSION)){session_start();}
    //if($_SERVER["REQUEST_URI"] != "../index.php") { header('location:../index.php');}
    if( (!isset ($_SESSION['email'])== true) || (!isset ($_SESSION['password']) == true) || ($_SESSION['admin'] == 0) ) {
        session_destroy();header('location:../views/formLogin.php');
    }

    $selectServico = $pdo->prepare("SELECT tb_servico.cd_servico, tb_servico.nm_servico FROM tb_servico");
    $selectServico->execute();
    $option = $selectServico ->fetchAll(PDO::FETCH_ASSOC);

    $limit = 13;
    $num_total = $pdo->prepare ("SELECT cd_agendamento FROM tb_agendamento");
    $num_total->execute();
    $total_records = $num_total->rowCount();
    $total_pages = ceil($total_records / $limit);
	
	$nome = $_SESSION['nameUser']; //recebe a variavel que possui o nome
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
                        <li><a href="formPainelUserAdm.php">Usuário</a></li>
                        <li><a href="formPaineListUser.php">Lista de Usuários</a></li>
                        <li><a href="formPaineIndexlAdm.php">Perfil Inicial</a></li>
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
    <div class="form-horizontal">
        <div id="wrapper" class="full">
            <div id="content" class="max">
                <div class="tables">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Agendamentos</div>
                                <div class="panel-body">
                                    <div class="form-control-static">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="container">
                                                    <div class='col-md-3 '>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">De:</label>
                                                            <div class='input-group date' id='datetimepickerbefore'>
                                                                <input type='text' class="form-control" />
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-3'>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Até:</label>
                                                            <div class='input-group date' id='datetimepickerafter'>
                                                                <input type='text' class="form-control"/>
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" id="Listar" name="Listar" value="Listar" class="btn btn-green" style="float: right;"><span class="fa fa-list state"></span>&nbsp;Listar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-overflow" id="target-content"></div>
                    <div id="hPagination" style="float: right;">
                        <ul class='pagination text-center' id="pagination">
                            <?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):if($i == 1):?>
                                <li class='active'  id="<?php echo $i;?>">
                                    <a href='ajax/paginationAgendamento.php?page=<?php echo $i;?>'>
                                        <?php echo $i;?>
                                    </a>
                                </li>
                            <?php else:?>
                                <li id="<?php echo $i;?>">
                                    <a href='ajax/paginationAgendamento.php?page=<?php echo $i;?>'>
                                        <?php echo $i;?>
                                    </a>
                                </li>
                            <?php endif;?>
                            <?php endfor;endif;?>
                        </ul>
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

    <!--JQUERY DATE-->
    <script type="text/javascript">
       var datepickerBefore = null;
       var datepickerAfter = null;

        $(document).ready( function(){
           datepickerBefore =  $('#datetimepickerbefore').datetimepicker();
           datepickerAfter = $('#datetimepickerafter').datetimepicker({
                useCurrent: false //Important! See issue #1075
            });
            $("#datetimepickerbefore").on("dp.change", function (e) {
                $('#datetimepickerafter').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepickerafter").on("dp.change", function (e) {
                $('#datetimepickerbefore').data("DateTimePicker").maxDate(e.date);
            });
        });

        $('#Listar').click(function (){
            var dtBefore, timeBefore, dateAfter, timeAfter;
            dtBefore  =  datepickerBefore.data().DateTimePicker.date().format('YYYY-MM-DD');
            tBefore  =  datepickerBefore.data().DateTimePicker.date().format('HH:mm');
            dtAfter   =  datepickerAfter.data().DateTimePicker.date().format('YYYY-MM-DD');
            tAfter   = datepickerAfter.data().DateTimePicker.date().format('HH:mm');
            
            $.post( 'ajax/paginationAgendamento.php', {
                dateBefore: dtBefore,
                timeBefore: tBefore,
                dateAfter:  dtAfter,
                timeAfter:  tAfter
            });
            });
    </script>

    <!--JQUERY PAGINATION-->
    <script type="text/javascript">
        $('#Listar').click(function () {
            jQuery(document).ready(function () {
                jQuery("#target-content").load("ajax/paginationAgendamento.php?page=1");
                jQuery("#pagination li").click('click',function(e){
                    e.preventDefault();
                    jQuery("#pagination li").removeClass('active');
                    jQuery(this).addClass('active');
                    var pageNum = this.id;
                    jQuery("#target-content").load("ajax/paginationAgendamento.php?page=" + pageNum);
                });
            });
            $('#hPagination').show();
        });
        $('#hPagination').click(function () {
            var nanobar = new Nanobar();
            // move bar
            nanobar.go( 30 ); // size bar 30%
            nanobar.go( 76 ); // size bar 76%
            // size bar 100% and and finish
            nanobar.go(100);
        });
        $('#hPagination').hide();
    </script>
</body>

</html>