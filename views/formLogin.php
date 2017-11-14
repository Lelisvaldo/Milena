<?php
    ini_set('default_charset','UTF-ISO-8859-15');
    include '../fbLogin/index.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Entrar</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="../assetsLogin/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assetsLogin/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../assetsLogin/css/form-elements.css">
        <link rel="stylesheet" href="../assetsLogin/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="../assetsLogin/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assetsLogin/ico/apple-icon-144x144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assetsLogin/ico/apple-icon-114x114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assetsLogin/ico/apple-icon-72x72.png">
        <link rel="apple-touch-icon-precomposed" href="../assetsLogin/ico/apple-icon-57x57.png">

    </head>

    <body>
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
							<a href="../index.php" class="text" style="text-align: center;  font-size: 50px;" >Milena</a>
                            <div class="description">
								<p>Aqui quem escolhe o local é você.</p>
							</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Acesse nosso site</h3>
	                            		<p>Digite o nome de usuário e senha para fazer login:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-lock"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="../userSession.php" method="POST" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-username">Email</label>
				                        	<input type="text" name="username" required placeholder="Email..." class="form-username form-control" id="form-username" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Senha</label>
				                        	<input type="password" name="password" required placeholder="Senha..." class="form-password form-control" id="form-password" minlength="3">
				                        </div>
				                        <button type="submit" class="btn">Entrar</button>
				                    </form>
			                    </div>
		                    </div>
                            <div class="social-login">
	                        	<h3>...Ou faça login com:</h3>
	                        	<div class="social-login-buttons">
									<?php echo '<a class="btn btn-link-2" href="' . $loginUrl . '"><i class="fa fa-facebook"></i>Facebook</a>';?>
		                        	<!--<a class="btn btn-link-2" href="#"><i class="fa fa-google"></i> Google</a>-->
	                        	</div>
	                        </div>
                        </div>
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Inscreva-se agora</h3>
	                            		<p>Preencha o formulário abaixo para obter acesso:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="../formViewsDB/insertNewUser.php" method="post" class="registration-form"/>
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-first-name">Nome</label>
				                        	<input type="text" name="formCadName" required placeholder="Nome..." class="form-first-name form-control" id="form-first-name" pattern="[A-Z a-z\s][A-Z a-z\s]+$"/>
				                        </div>
										<div class="form-group">
											<label class="sr-only" for="form-cpf-cnpj">CPF/CNPJ</label>
											<input type="text" name="formCadCpfCnpj" required placeholder="CPF/CNPJ" class="form-email form-control cpf_cnpj" id="form-email" minlength="11"/>
										</div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-email">Email</label>
				                        	<input type="text" name="formCadEmail" required placeholder="Email..." class="form-email form-control" id="form-email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/>
				                        </div>
										<div class="form-group">
											<label class="sr-only" for="form-password">Senha</label>
											<input type="password" name="formCadpassword" minlength="3" required placeholder="Senha..." class="form-email form-control" id="form-password"/>
										</div>
				                        <button type="submit" class="btn">Cadastre-me!</button>
				                    </form>
			                    </div>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Javascript -->
        <script src="../assetsLogin/js/jquery-1.11.1.min.js"></script>
        <script src="../assetsLogin/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assetsLogin/js/jquery.backstretch.min.js"></script>
        <script src="../assetsLogin/js/scripts.js"></script>
        <!-- Funções para validação de CPF e CNPJ -->
        <script src="../js/valida_cpf_cnpj/valida_cpf_cnpj.js"></script>
        <!-- Pressionando teclas -->
        <!--<script src="../js/valida_cpf_cnpj/exemplo_1.js"></script>-->
        <!-- Após sair do campo -->
        <script src="../js/valida_cpf_cnpj/exemplo_2.js"></script>
        <!-- Formatando o CPF ou CNPJ -->
        <script src="../js/valida_cpf_cnpj/exemplo_3.js"></script>

        <!--[if lt IE 10]>
        <script src="../assetsLogin/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>