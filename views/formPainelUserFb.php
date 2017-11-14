<?php ini_set('default_charset','UTF-8'); if(!isset($_SESSION)){session_start();} if(!isset ($_SESSION['email'])== true ) { session_destroy(); header('location:../views/formLogin.php');}
    $nome = $_SESSION['nameUser']; //recebe a variavel que Possue o nome
	$nome_separado = explode(" ",$nome); //explode 
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-ISO-8859-1">
        <meta http-equiv="Content-Type" content="text/php; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>Dados de Usuários</title>
        <link href="../css_Painel/font-awesome.css" rel="stylesheet">
        <link href="../css_Painel/simple-line-icons.css" rel="stylesheet">
        <link href="../css_Painel/jquery-ui.css" rel="stylesheet">
        <link href="../css_Painel/jquery.tagsinput.css" rel="stylesheet">
        <link href="../css_Painel/fileinput.min.css" rel="stylesheet">
        <link href="../css_Painel/bootstrap.css" rel="stylesheet">
        <link href="../css_Painel/app.css" rel="stylesheet">
        <link rel="shortcut icon" href="../img/icon/Incon.ico">

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Adicionando JQuery -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <!-- Adicionando Javascript-->
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
                        <li><a href="formPainelAgendamentoUser.php"><span class="icon-calendar"></span>Agendamento</a></li>
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
                        <a href="formPainelAgendamentoUser.php"><span class="navIcon icon-calendar"></span><span class="navLabel">Agendar</span></a>
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
                    <li><a href="formPainelAgendamentoUser.php"><span class="icon-calendar"></span>Agendamento</a></li>
                    <li class="divider"></li>
                    <li><a href="../logout.php"><span class="icon-power"></span>Sair</a></li>
                </ul>
            </div>
        </div>
        <div class="closeLeftSide"></div>

        <!-- Content -->
        <div id="wrapper" class="full">
            <div id="content" class="max">
                <div class="tables">
                    <!--<h4>Alterar Dados do Usuário</h4>-->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Usuário</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" action="../formViewsDB/formPainelUserCRUD.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">USUÁRIO</label>
                                            <div class="col-sm-3">
                                                <input name="nameUser" type="text" class="form-control round" value="<?php echo $_SESSION ['nameUser'];?>" />
                                            </div>
                                        </div>
                                        <!--tratar tipo-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">CPF/CNPJ</label>
                                            <div class="col-sm-3">
                                                <input name="textCpfCnpj" type="text" class="form-control round cpf_cnpj" placeholder="000.000.000-00 - 00.000.000/0000-00" minlength="11" value="<?php echo $_SESSION['cpfCnpj'];?>">
                                            </div>
                                            <label class="col-sm-2 control-label">PESSOA</label>
                                            <div class="col-sm-3">
                                                <div class="form-control-static" style="margin-top: -7px;">
                                                    <div class="radio custom-radio radio-inline" style="margin-left: -20px;">
                                                        <label>
                                                            <input name="radioCheCpfCnpj" type="radio" value="1" <?php echo ($_SESSION[ 'icTipoUser']=="1" ) ? "checked" : null; ?> ><span class="fa fa-circle"></span> Fisica</label>
                                                    </div>
                                                    <div class="radio custom-radio radio-inline" style="margin-left: -10px;">
                                                        <label>
                                                            <input name="radioCheCpfCnpj" type="radio" value="0" <?php echo ($_SESSION[ 'icTipoUser']=="0" ) ? "checked" : null; ?> ><span class="fa fa-circle"></span> Juridica</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Telefones-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">CELULAR 1</label>
                                            <div class="col-sm-3">
                                                <input name="telCelular1" type="tel" class="form-control round" placeholder="(00) 00000-0000" value="<?php echo $_SESSION['telCelular1'];?>">
                                            </div>
                                            <label class="col-sm-2 control-label">WHATSAPP</label>
                                            <div class="col-sm-3">
                                                <div class="checkbox switch">
                                                    <label>
                                                        <input name="checkboxWhatsCel1" type="checkbox" <?php echo ($_SESSION[ 'WhatsCel1']=="1" ) ? "checked" : null; ?>/>
                                                        <span class="cs-place"><span class="fa fa-check cs-handler"></span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">CELULAR 2</label>
                                            <div class="col-sm-3">
                                                <input name="telCelular2" type="tel" class="form-control round" placeholder="(00) 00000-0000" value="<?php echo $_SESSION['telCelular2'];?>">
                                            </div>
                                            <label class="col-sm-2 control-label">WHATSAPP</label>
                                            <div class="col-sm-3">
                                                <div class="checkbox switch">
                                                    <label>
                                                        <input name="checkboxWhatsCel2" type="checkbox" <?php echo ($_SESSION[ 'WhatsCel2']=="1" ) ? "checked" : null; ?>/>
                                                        <span class="cs-place"><span class="fa fa-check cs-handler"></span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">CELULAR 3</label>
                                            <div class="col-sm-3">
                                                <input name="telCelular3" type="tel" class="form-control round" placeholder="(00) 00000-0000" value="<?php echo $_SESSION['telCelular3'];?>">
                                            </div>
                                            <label class="col-sm-2 control-label">WHATSAPP</label>
                                            <div class="col-sm-3">
                                                <div class="checkbox switch">
                                                    <label>
                                                        <input name="checkboxWhatsCel3" type="checkbox" <?php echo ($_SESSION[ 'WhatsCel3']=="1" ) ? "checked" : null; ?>/>
                                                        <span class="cs-place"><span class="fa fa-check cs-handler"></span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">TELEFONE FIXO</label>
                                            <div class="col-sm-3">
                                                <input name="telFixo" type="tel" class="form-control round" placeholder="(00) 0000-0000" value="<?php echo $_SESSION['telFixo'];?>">
                                            </div>
                                        </div>
                                        <!--Dados do Endereço-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">CEP</label>
                                            <div class="col-sm-3">
                                                <input name="cep" type="text" id="cep" class="form-control round" placeholder="00000-000" size="10" maxlength="9" value="<?php echo @$_SESSION['cep'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">RUA</label>
                                            <div class="col-sm-5">
                                                <input name="rua" type="text" class="form-control round" placeholder="AV. marcos Freire" id="rua" size="60" value="<?php echo @$_SESSION['rua'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nº</label>
                                            <div class="col-sm-3">
                                                <input name="numeroEndereco" type="text" class="form-control round" value="<?php echo @$_SESSION['numeroEndereco'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">COMPLEMENTO</label>
                                            <div class="col-sm-5">
                                                <input name="complemento" type="text" class="form-control round" placeholder="" value="<?php echo @$_SESSION['complemento'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">PONTO DE REFERÊNCIA</label>
                                            <div class="col-sm-5">
                                                <input name="pRef" type="text" class="form-control round" placeholder="Prox. Praça" value="<?php echo @$_SESSION['pRef'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">BAIRRO</label>
                                            <div class="col-sm-3">
                                                <input name="bairro" type="text" class="form-control round" id="bairro" size="40" value="<?php echo @$_SESSION['bairro'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">CIDADE</label>
                                            <div class="col-sm-3">
                                                <input name="cidade" type="text" class="form-control round" id="cidade" size="40" value="<?php echo @$_SESSION['cidade'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">UF</label>
                                            <div class="col-sm-3">
                                                <input name="uf" type="text" class="form-control round" id="uf" size="2" value="<?php echo @$_SESSION['uf'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">IBGE</label>
                                            <div class="col-sm-3">
                                                <input name="ibge" type="text" class="form-control round" id="ibge" size="8" value="<?php echo @$_SESSION['cd_ibge'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">E-MAIL</label>
                                            <div class="col-sm-3">
                                                <input name="email" type="email" class="form-control round" placeholder="exemplo@milena.com.br" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo @$_SESSION['email'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">SENHA</label>
                                            <div class="col-sm-3">
                                                <input name="password" type="password" class="form-control round" placeholder="Senha" value="">
                                            </div>
                                        </div>
                                        <!--Upload da Imagen / admin-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">IMAGEM</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="file" name="imgUser" data-show-upload="false" data-show-caption="false" data-show-remove="false" accept="image/jpeg,image/png" data-browse-class="btn btn-o btn-default" data-browse-label="Upload Imagem" />
                                                <p class="help-block">VOCÊ PODE SELECIONAR APENAS UMA IMAGEM!</p>
                                            </div>
                                            <label class="col-sm-2 control-label">ADMINISTRADOR</label>
                                            <div class="col-sm-3">
                                                <div class="checkbox switch">
                                                    <label>
                                                        <input name="checkboxAdmin" type="checkbox" <?php echo (@$_SESSION[ 'admin']==0 ) ? "disabled" : null; echo (@$_SESSION[ 'admin']==1 ) ? "checked" : null; ?> >
                                                        <span class="cs-place"><span class="fa fa-check cs-handler"></span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="Gravar" value="Gravar" class="btn btn-green" style="float: right;"><span class="fa fa-save state"></span> Salvar</button>
                                    </form>
                                    <form class="form-horizontal" role="form" action="../formViewsDB/deleteUser.php" method="POST" enctype="multipart/form-data">
                                        <button type="submit" name="Gravar" value="Gravar" class="btn btn-danger" style="margin-right: 10px; float: right;"><span class="fa fa-remove state"></span> Deletar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <script src="../js/jquery-2.1.1.min.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <script src="../js/jquery-ui-touch-punch.js"></script>
        <script src="../js/jquery.placeholder.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/jquery.touchSwipe.min.js"></script>
        <script src="../js/jquery.slimscroll.min.js"></script>
        <script src="../js/jquery.visible.js"></script>
<!--        <script src="http://maps.googleapis.com/maps/api/js?sensor=true&amp;libraries=geometry&amp;libraries=places" type="text/javascript"></script>-->
<!--        <script src="../js/infobox.js"></script>-->
        <script src="../js/jquery.tagsinput.min.js"></script>
        <script src="../js/fileinput.min.js"></script>
        <script src="../js/app.js" type="text/javascript"></script>
        <!-- Funções para validação de CPF e CNPJ -->
        <script src="../js/valida_cpf_cnpj/valida_cpf_cnpj.js"></script>
        <!-- Pressionando teclas -->
        <!--<script src="../js/valida_cpf_cnpj/exemplo_1.js"></script>-->
        <!-- Após sair do campo -->
        <script src="../js/valida_cpf_cnpj/exemplo_2.js"></script>
        <!-- Formatando o CPF ou CNPJ -->
        <script src="../js/valida_cpf_cnpj/exemplo_3.js"></script>
        <!-- Adicionando Javascript CEP-->
        <script type="text/javascript">
            $(document).ready(function() {
                function limpa_formulário_cep() {
                    // Limpa valores do formulário de cep.
                    $("#rua").val("");
                    $("#bairro").val("");
                    $("#cidade").val("");
                    $("#uf").val("");
                    $("#ibge").val("");
                }
                //Quando o campo cep perde o foco.
                $("#cep").focusout(function() {
                    //Nova variável "cep" somente com dígitos.
                    var cep = $(this).val().replace(/\D/g, '');
                    //Verifica se campo cep possui valor informado.
                    if (cep != "") {
                        //Expressão regular para validar o CEP.
                        var validacep = /^[0-9]{8}$/;
                        //Valida o formato do CEP.
                        if (validacep.test(cep)) {
                            //Preenche os campos com "..." enquanto consulta webservice.
                            $("#rua").val("...");
                            $("#bairro").val("...");
                            $("#cidade").val("...");
                            $("#uf").val("...");
                            $("#ibge").val("...");
                            //Consulta o webservice viacep.com.br/
                            $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                                if (!("erro" in dados)) {
                                    //Atualiza os campos com os valores da consulta.
                                    $("#rua").val(dados.logradouro);
                                    $("#bairro").val(dados.bairro);
                                    $("#cidade").val(dados.localidade);
                                    $("#uf").val(dados.uf);
                                    $("#ibge").val(dados.ibge);
                                } //end if.
                                else {
                                    //CEP pesquisado não foi encontrado.
                                    limpa_formulário_cep();
                                    alert("CEP não encontrado.");
                                }
                            });
                        } //end if.
                        else {
                            //cep é inválido.
                            limpa_formulário_cep();
                            alert("Formato de CEP inválido.");
                        }
                    } //end if.
                    else {
                        //cep sem valor, limpa formulário.
                        limpa_formulário_cep();
                    }
                });
            });
        </script>
    </body>
</html>