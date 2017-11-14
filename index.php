<?php ini_set('default_charset','UTF-8');
    if(!isset($_SESSION)){session_start();}
    include "conn.php";

    $selectTxIndex = $pdo->prepare ("SELECT
    tb_texto_header_index.ds_titulo_header,
    tb_texto_header_index.ds_sub_titulo_header,
    tb_texto_servico_index.ds_sub_titulo_servico,
    tb_texto_servico_index.ds_titulo_servico_1,
    tb_texto_servico_index.ds_servico_1,
    tb_texto_servico_index.ds_titulo_servico_2,
    tb_texto_servico_index.ds_servico_2,
    tb_texto_servico_index.ds_titulo_servico_3,
    tb_texto_servico_index.ds_servico_3,
    tb_texto_sobre_index.ds_sub_titulo_sobre,
    tb_texto_sobre_index.dt_sobre_1,
    tb_texto_sobre_index.ds_titulo_sobre_1,
    tb_texto_sobre_index.ds_desc_sobre_1,
    tb_texto_sobre_index.dt_sobre_2,
    tb_texto_sobre_index.ds_titulo_sobre_2,
    tb_texto_sobre_index.ds_desc_sobre_2,
    tb_texto_sobre_index.dt_sobre_3,
    tb_texto_sobre_index.ds_titulo_sobre_3,
    tb_texto_sobre_index.ds_desc_sobre_3,
    tb_texto_sobre_index.dt_sobre_4,
    tb_texto_sobre_index.ds_titulo_sobre_4,
    tb_texto_sobre_index.ds_desc_sobre_4
    FROM tb_perfil_index
    INNER JOIN tb_texto_header_index
    ON tb_perfil_index.cd_perfil = tb_texto_header_index.cd_perfil
    INNER JOIN tb_texto_servico_index
    ON tb_perfil_index.cd_perfil = tb_texto_servico_index.cd_perfil
    INNER JOIN tb_texto_sobre_index
    ON tb_perfil_index.cd_perfil = tb_texto_sobre_index.cd_perfil
    WHERE tb_perfil_index.cd_perfil_index_ativo = 1");
    $selectTxIndex->execute();
    $query_num_rowsSelecteUser = $selectTxIndex->rowCount();
    $resultTxIndex = $selectTxIndex->fetch(PDO::FETCH_ASSOC);

    $selectIcon = $pdo->prepare ("SELECT tb_glyphicon.nm_icone FROM tb_glyphicon , tb_perfil_index WHERE tb_perfil_index.cd_perfil_index_ativo =1");
    $selectIcon->execute();
    $query_num_rowsIcon = $selectIcon->rowCount();
    $icons = [];
    if ($query_num_rowsIcon> 0) {
        while($row = $selectIcon->fetch(PDO::FETCH_ASSOC)) {
            array_push($icons,$row["nm_icone"]);
            //			 var_dump($row["nm_icone"]);
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-ISO-8859-1">
        <meta http-equiv="Content-Type" content="text/php; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>IBL Consultoria</title>

        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

        <!-- Theme CSS -->
        <link href="css/agency.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
        <![endif]-->
    </head>

    <body id="page-top" class="index">
        <!-- Navigation não logado-->
        <?php
            if( (isset ($_SESSION['email'])== false) || (isset ($_SESSION['idUser']) == false)) {
                echo ("
                        <nav id=\"mainNav\" class=\"navbar navbar-default navbar-custom navbar-fixed-top\">
                            <div class=\"container\">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class=\"navbar-header page-scroll\">
                                    <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
                                        <span class=\"sr-only\">Toggle navigation</span> Menu <i class=\"fa fa-bars\"></i>
                                    </button>
                                    <a class=\"navbar-brand page-scroll\" href=\"#page-top\">IBL Consultoria</a>
                                </div>
                                <!-- Menu Superior -->
                                <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                                    <ul class=\"nav navbar-nav navbar-right\">
                                        <li class=\"hidden\">
                                            <a href=\"#page-top\"></a>
                                        </li>
                                        <li>
                                            <a class=\"page-scroll\" href=\"#services\">Serviços</a>
                                        </li>
                                        <li>
                                            <a class=\"page-scroll\" href=\"#portfolio\">Portfólio</a>
                                        </li>
                                        <li>
                                            <a class=\"page-scroll\" href=\"#about\">Empresa</a>
                                        </li>
                                        <li>
                                            <a class=\"page-scroll\" href=\"#team\">Equipe</a>
                                        </li>
                                        <li>
                                            <a class=\"page-scroll\" href=\"#contact\">Onde Atendemos</a>
                                        </li>
                                        <li>
                                            <a class=\"page-scroll\" href=\"validation.php\">Entrar</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.navbar-collapse -->
                            </div>
                        <!-- /.container-fluid -->
                        </nav>
                ");
            }
            elseif( (isset ($_SESSION['email'])== true) || (isset ($_SESSION['idUser']) == true)) {
                if ($_SESSION['admin'] == 0){
                    echo ("
                           <nav id=\"mainNav\" class=\"navbar navbar-default navbar-custom navbar-fixed-top\">
                                <div class=\"container\">
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <div class=\"navbar-header page-scroll\">
                                        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
                                            <span class=\"sr-only\">Toggle navigation</span> Menu <i class=\"fa fa-bars\"></i>
                                        </button>
                                        <a class=\"navbar-brand page-scroll\" href=\"#page-top\">IBL Consultoria</a>
                                    </div>
                                    <!-- Menu Superior -->
                                    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                                        <ul class=\"nav navbar-nav navbar-right\">
                                            <li class=\"hidden\">
                                                <a href=\"#page-top\"></a>
                                            </li>
                                            <li>
                                                <a class=\"page-scroll\" href=\"#services\">Serviços</a>
                                            </li>
                                            <li>
                                                <a href=\"views/formPainelAgendamentoUser.php\">Agenda</a>
                                            </li>
                                            <li>
                                                <a class=\"page-scroll\" href=\"#portfolio\">Portfólio</a>
                                            </li>
                                            <li>
                                                <a class=\"page-scroll\" href=\"#about\">Empresa</a>
                                            </li>
                                            <li>
                                                <a class=\"page-scroll\" href=\"#team\">Equipe</a>
                                            </li>
                                            <li>
                                                <a class=\"page-scroll\" href=\"#\">Contato</a>
                                            </li>
                                            <li>
                                                <a href=\"views/formPainelUserFb.php\">Conta</a>
                                            </li>
                                            <li>
                                                <a href=\"logout.php\">Sair</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.navbar-collapse -->
                                </div>
                           <!-- /.container-fluid -->
                           </nav>
                    ");
                }
                elseif ($_SESSION['admin'] == 1){
                    echo ("
                           <nav id=\"mainNav\" class=\"navbar navbar-default navbar-custom navbar-fixed-top\">
                                <div class=\"container\">
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <div class=\"navbar-header page-scroll\">
                                        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
                                            <span class=\"sr-only\">Toggle navigation</span> Menu <i class=\"fa fa-bars\"></i>
                                        </button>
                                        <a class=\"navbar-brand page-scroll\" href=\"#page-top\">IBL Consultoria</a>
                                    </div>
                                    <!-- Menu Superior -->
                                    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                                        <ul class=\"nav navbar-nav navbar-right\">
                                            <li class=\"hidden\">
                                                <a href=\"#page-top\"></a>
                                            </li>
                                            <li>
                                                <a class=\"page-scroll\" href=\"#services\">Serviços</a>
                                            </li>
                                            <li>
                                                <a href=\"views/formPainelAgendamentoAdm.php\">Agenda</a>
                                            </li>
                                            <li>
                                                <a class=\"page-scroll\" href=\"#portfolio\">Portfólio</a>
                                            </li>
                                            <li>
                                                <a class=\"page-scroll\" href=\"#about\">Empresa</a>
                                            </li>
                                            <li>
                                                <a class=\"page-scroll\" href=\"#team\">Equipe</a>
                                            </li>
                                            <li>
                                                <a class=\"page-scroll\" href=\"#contact\">Onde Atendemos</a>
                                            </li>
                                            <li>
                                                <a href=\"views/dashboard.php\">Painel</a>
                                            </li>
                                            <li>
                                                <a href=\"logout.php\">Sair</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.navbar-collapse -->
                                </div>
                           <!-- /.container-fluid -->
                           </nav>
                    ");
                }
            }
        ?>
        <!-- Header -->
        <header>
            <div class="container">
                <div class="intro-text">
                    <div class="intro-lead-in">
                        <?php echo $resultTxIndex ["ds_titulo_header"];?>
                    </div>
                    <div class="intro-heading">
                        <?php echo $resultTxIndex ["ds_sub_titulo_header"]?>
                    </div>
                    <a href="#services" class="page-scroll btn btn-xl">Saiba Mais</a>
                </div>
            </div>
        </header>

        <!-- Services Section -->
        <section id="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Serviços</h2>
                        <h3 class="section-subheading text-muted"><?php echo $resultTxIndex["ds_sub_titulo_servico"];?></h3>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa <?php echo $icons[0] ?> fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading"><?php echo $resultTxIndex ["ds_titulo_servico_1"];?></h4>
                        <p class="text-muted"><?php echo $resultTxIndex ["ds_servico_1"];?></p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa <?php echo $icons[1] ?>  fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading"><?php echo $resultTxIndex ["ds_titulo_servico_2"];?></h4>
                        <p class="text-muted"><?php echo $resultTxIndex ["ds_servico_2"];?></p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa <?php echo $icons[2] ?>  fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading"><?php echo $resultTxIndex ["ds_titulo_servico_3"];?></h4>
                        <p class="text-muted"><?php echo $resultTxIndex ["ds_servico_3"];?></p>
                    </div>
                    <a href="views/formPainelAgendamentoUser.php" class="page-scroll btn btn-xl" style="margin-top: 3%;">Agendar</a>
                </div>
            </div>
        </section>

        <!-- Portfolio Grid Section -->
        <section id="portfolio" class="bg-light-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Portfólio</h2>
                        <h3 class="section-subheading text-muted">instagram.com/ibl</h3>
                    </div>
                </div>
                <div id='ody'></div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">SOBRE</h2>
                        <h3 class="section-subheading text-muted"><?php echo $resultTxIndex ["ds_sub_titulo_sobre"];?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="timeline">
                            <li>
                                <div class="timeline-image">
                                    <img class="img-circle img-responsive" src="img/about/1.jpg" alt="">
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4><?php echo $resultTxIndex ["dt_sobre_1"];?></h4>
                                        <h4 class="subheading"><?php echo $resultTxIndex ["ds_titulo_sobre_1"];?></h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p class="text-muted">
                                            <?php echo $resultTxIndex ["ds_desc_sobre_1"];?>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-image">
                                    <img class="img-circle img-responsive" src="img/about/2.jpg" alt="">
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4><?php echo $resultTxIndex ["dt_sobre_2"];?></h4>
                                        <h4 class="subheading"><?php echo $resultTxIndex ["ds_titulo_sobre_2"];?></h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p class="text-muted">
                                            <?php echo $resultTxIndex ["ds_desc_sobre_2"];?>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-image">
                                    <img class="img-circle img-responsive" src="img/about/3.jpg" alt="">
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4><?php echo $resultTxIndex ["dt_sobre_3"];?></h4>
                                        <h4 class="subheading"><?php echo $resultTxIndex ["ds_titulo_sobre_3"];?></h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p class="text-muted">
                                            <?php echo $resultTxIndex ["ds_desc_sobre_3"];?>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-image">
                                    <img class="img-circle img-responsive" src="img/about/1.jpg" alt="">
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4><?php echo $resultTxIndex ["dt_sobre_4"];?></h4>
                                        <h4 class="subheading"><?php echo $resultTxIndex ["ds_titulo_sobre_4"];?></h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p class="text-muted">
                                            <?php echo $resultTxIndex ["ds_desc_sobre_4"];?>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-image">
                                    <h4>Faça parte<br>da nossa<br>história!</h4>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section id="team" class="bg-light-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">NOSSA EQUIPE</h2>
                        <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="team-member">
                            <img src="img/team/L1.jpg" class="img-responsive img-circle" alt="">
                            <h4>Lelisvaldo Gomes</h4>
                            <p class="text-muted">Developer - Designer</p>
                            <ul class="list-inline social-buttons">
                                <li><a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="team-member">
                            <img src="img/team/B.jpg" class="img-responsive img-circle" alt="">
                            <h4>Bruno Ramos</h4>
                            <p class="text-muted">Dba</p>
                            <ul class="list-inline social-buttons">
                                <li><a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="team-member">
                            <img src="img/team/I.jpg" class="img-responsive img-circle" alt="">
                            <h4>Isabela Prudencio</h4>
                            <p class="text-muted">Designer Jr</p>
                            <ul class="list-inline social-buttons">
                                <li><a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="team-member">
                            <img src="img/team/R.jpg" class="img-responsive img-circle" alt="">
                            <h4>Renan Lima</h4>
                            <p class="text-muted">Analista Jr</p>
                            <ul class="list-inline social-buttons">
                                <li><a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
            <section id="contact">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2 class="section-heading">Locais que Atendemos</h2>
                            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                        </div>
                    </div>
                </div>
            </section>


        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <span class="copyright">Copyright &copy; Your Website 2017</span>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-inline social-buttons">
                            <li>
                                <a href="https://www.facebook.com/ibl"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/ibl/"><i class="fa fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-inline quicklinks">
                            <li><a href="terms.html#policies">Política de Privacidade</a>
                            </li>
                            <li><a href="terms.html#terms">Termos de Uso</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- jQuery -->
        <script src="vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

        <!-- Contact Form JavaScript -->
        <script src="js/jqBootstrapValidation.js"></script>
        <script src="js/contact_me.js"></script>

        <!-- Theme JavaScript -->
        <script src="js/agency.min.js"></script>

        <script type='text/javascript'>
            (function(){var e,t;e=function(){function e(e,t){var n,r;this.options={target:"ody",get:"popular",resolution:"thumbnail",sortBy:"none",links:!0,mock:!1,useHttp:!1};if(typeof e=="object")for(n in e)r=e[n],this.options[n]=r;this.context=t!=null?t:this,this.unique=this._genKey()}return e.prototype.hasNext=function(){return typeof this.context.nextUrl=="string"&&this.context.nextUrl.length>0},e.prototype.next=function(){return this.hasNext()?this.run(this.context.nextUrl):!1},e.prototype.run=function(t){var n,r,i;if(typeof this.options.clientId!="string"&&typeof this.options.accessToken!="string")throw new Error("Missing clientId or accessToken.");if(typeof this.options.accessToken!="string"&&typeof this.options.clientId!="string")throw new Error("Missing clientId or accessToken.");return this.options.before!=null&&typeof this.options.before=="function"&&this.options.before.call(this),typeof document!="undefined"&&document!==null&&(i=document.createElement("script"),i.id="ody-fetcher",i.src=t||this._buildUrl(),n=document.getElementsByTagName("head"),n[0].appendChild(i),r="odyCache"+this.unique,window[r]=new e(this.options,this),window[r].unique=this.unique),!0},e.prototype.parse=function(e){var t,n,r,i,s,o,u,a,f,l,c,h,p,d,v,m,g,y,b,w,E,S;if(typeof e!="object"){if(this.options.error!=null&&typeof this.options.error=="function")return this.options.error.call(this,"Invalid JSON data"),!1;throw new Error("Invalid JSON response")}if(e.meta.code!==200){if(this.options.error!=null&&typeof this.options.error=="function")return this.options.error.call(this,e.meta.error_message),!1;throw new Error("Error from Instagram: "+e.meta.error_message)}if(e.data.length===0){if(this.options.error!=null&&typeof this.options.error=="function")return this.options.error.call(this,"No images were returned from Instagram"),!1;throw new Error("No images were returned from Instagram")}this.options.success!=null&&typeof this.options.success=="function"&&this.options.success.call(this,e),this.context.nextUrl="",e.pagination!=null&&(this.context.nextUrl=e.pagination.next_url);if(this.options.sortBy!=="none"){this.options.sortBy==="random"?d=["","random"]:d=this.options.sortBy.split("-"),p=d[0]==="least"?!0:!1;switch(d[1]){case"random":e.data.sort(function(){return.5-Math.random()});break;case"recent":e.data=this._sortBy(e.data,"created_time",p);break;case"liked":e.data=this._sortBy(e.data,"likes.count",p);break;case"commented":e.data=this._sortBy(e.data,"comments.count",p);break;default:throw new Error("Invalid option for sortBy: '"+this.options.sortBy+"'.")}}if(typeof document!="undefined"&&document!==null&&this.options.mock===!1){a=e.data,this.options.limit!=null&&a.length>this.options.limit&&(a=a.slice(0,this.options.limit+1||9e9)),n=document.createDocumentFragment(),this.options.filter!=null&&typeof this.options.filter=="function"&&(a=this._filter(a,this.options.filter));if(this.options.template!=null&&typeof this.options.template=="string"){i="",o="",l="",v=document.createElement("div");for(m=0,b=a.length;m<b;m++)s=a[m],u=s.images[this.options.resolution].url,this.options.useHttp||(u=u.replace("http://","//")),o=this._makeTemplate(this.options.template,{model:s,id:s.id,link:s.link,image:u,caption:this._getObjectProperty(s,"caption.text"),likes:s.likes.count,comments:s.comments.count,location:this._getObjectProperty(s,"location.name")}),i+=o;v.innerHTML=i,S=[].slice.call(v.childNodes);for(g=0,w=S.length;g<w;g++)h=S[g],n.appendChild(h)}else for(y=0,E=a.length;y<E;y++)s=a[y],f=document.createElement("img"),u=s.images[this.options.resolution].url,this.options.useHttp||(u=u.replace("http://","//")),f.src=u,this.options.links===!0?(t=document.createElement("a"),t.href=s.link,t.appendChild(f),n.appendChild(t)):n.appendChild(f);document.getElementById(this.options.target).appendChild(n),r=document.getElementsByTagName("head")[0],r.removeChild(document.getElementById("ody-fetcher")),c="odyCache"+this.unique,window[c]=void 0;try{delete window[c]}catch(x){}}return this.options.after!=null&&typeof this.options.after=="function"&&this.options.after.call(this),!0},e.prototype._buildUrl=function(){var e,t,n;e="https://api.instagram.com/v1";switch(this.options.get){case"popular":t="media/popular";break;case"tagged":if(typeof this.options.tagName!="string")throw new Error("No tag name specified. Use the 'tagName' option.");t="tags/"+this.options.tagName+"/media/recent";break;case"location":if(typeof this.options.locationId!="number")throw new Error("No location specified. Use the 'locationId' option.");t="locations/"+this.options.locationId+"/media/recent";break;case"user":if(typeof this.options.userId!="number")throw new Error("No user specified. Use the 'userId' option.");if(typeof this.options.accessToken!="string")throw new Error("No access token. Use the 'accessToken' option.");t="users/"+this.options.userId+"/media/recent";break;default:throw new Error("Invalid option for get: '"+this.options.get+"'.")}return n=""+e+"/"+t,this.options.accessToken!=null?n+="?access_token="+this.options.accessToken:n+="?client_id="+this.options.clientId,this.options.limit!=null&&(n+="&count="+this.options.limit),n+="&callback=odyCache"+this.unique+".parse",n},e.prototype._genKey=function(){var e;return e=function(){return((1+Math.random())*65536|0).toString(16).substring(1)},""+e()+e()+e()+e()},e.prototype._makeTemplate=function(e,t){var n,r,i,s,o;r=/(?:\{{2})([\w\[\]\.]+)(?:\}{2})/,n=e;while(r.test(n))i=n.match(r)[1],s=(o=this._getObjectProperty(t,i))!=null?o:"",n=n.replace(r,""+s);return n},e.prototype._getObjectProperty=function(e,t){var n,r;t=t.replace(/\[(\w+)\]/g,".$1"),r=t.split(".");while(r.length){n=r.shift();if(!(e!=null&&n in e))return null;e=e[n]}return e},e.prototype._sortBy=function(e,t,n){var r;return r=function(e,r){var i,s;return i=this._getObjectProperty(e,t),s=this._getObjectProperty(r,t),n?i>s?1:-1:i<s?1:-1},e.sort(r.bind(this)),e},e.prototype._filter=function(e,t){var n,r,i,s,o;n=[],i=function(e){if(t(e))return n.push(e)};for(s=0,o=e.length;s<o;s++)r=e[s],i(r);return n},e}(),t=typeof exports!="undefined"&&exports!==null?exports:window,t.ody=e}).call(this);
             $( document ).ready(function() {
               var feed=new ody({get:"user",
                                    limit:3,
                                    resolution:"standard_resolution",
                                    template:`<div class="col-md-4 col-sm-6 portfolio-item">
                                            <a href="{{link}}" class="portfolio-link" data-toggle="modal">
                                            <div class="portfolio-hover">
                                                <div class="portfolio-hover-content">
                                                <i class="fa fa-instagram fa-3x"></i>
                                                </div>
                                            </div>
                                            <img style="width: 400px; height: 330px;" src="{{image}}" class="img-responsive" alt="">
                                            </a>
                                            <div class="portfolio-caption">
                                            <h4>{{likes}}&nbsp;<i class="fa fa-heart"></i></h4>
                                            <p class="text-muted">{{comments}}&nbsp;<i class="fa fa-comment"></i></p>
                                            </div>
                                        </div>`,
                                userId:1676020385,
                                accessToken:"1676020385.7cf589a.fe06ba2589184455a5827baccb6bc330"
                                });feed.run();
            });
        </script>
    </body>
</html>