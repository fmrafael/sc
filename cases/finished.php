<?php session_start();
//validates user can access cases.php
if($_SESSION['id_linkedin'] != true) {
	header("Location: auth.php");
    exit();
}	
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'config.php';
//selects case
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Mendl CrowdCaseSolution, conecta talentos, empresas, universidades e headhunters na solução de desafios reais de mercado" content="São sempre novos desafios que permite aos talentos e candidatos a apoiarem diretamente as empresas, através da resolução de casos reais de negócios">
    <title>Mendl CrowdCaseSolution | Talentos. Empresas. Universidades. Headhunters unidos para a solução de DESAFIOS reais.</title><title>Mendl Gestão de Treinamento a Distância</title>
    <!-- Bootstrap Core CSS -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-aweso	me/4.3.0/css/font-awesome.min.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:800,400,600' rel='stylesheet' type='text/css'>
    <!-- Custom CSS -->
    <link href="/css/one-page-wonder-case.css" rel="stylesheet">   
    <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon"> 
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>                   
                          <a class="navbar-brand" href="/cases/linkedin"><i class="fa fa-star"></i> Mendl CrowdCaseSolution</a>
                    </li>				      
                    </ul>
			
			<ul class="nav navbar-nav navbar-brand"><li>
						
						</li>
					</ul>
					</div>
        </div>
    </nav>
    <!-- Full Width Image Header -->
    <header class="header-image">
    <div class="container">		  
            <div class="row bs-wizard" style="border-bottom:0;">                                                      
                <div class="col-xs-4 bs-wizard-step complete"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum"><i class="fa fa-trophy"></i> 1°Etapa</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <div class="bs-wizard-dot"></div>                  
                </div>                
                <div class="col-xs-4 bs-wizard-step complete"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum"><i class="fa fa-trophy"></i><i class="fa fa-trophy"></i> 2°Etapa</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <div class="bs-wizard-dot"></div>
                  <div class="bs-wizard-info text-center"></div>
                </div>                
                <div class="col-xs-4 bs-wizard-step active"><!-- active -->
                  <div class="text-center bs-wizard-stepnum"><i class="fa fa-trophy"></i><i class="fa fa-trophy"></i><i class="fa fa-trophy"></i> 3°Etapa</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <div class="bs-wizard-dot"></div>
                  <div class="bs-wizard-info text-center">Solução compartilhada com o Mercado de Trabalho</div>
            </div>
            </div>
    
   <div>
        <div class="headline">
            <div class="container">                   
            <div class="col-xs-10 pull-right">                                                                                 
                <h3 class="text-center">Parabéns, <strong><?php echo  $_SESSION['formattedName']; ?>!</strong> 
                Mais um desafio resolvido. Quanto mais você participar, maiores suas chances
                de conseguir aquele emprego dos seus sonhos. Por isso, fique atento aos avisos de novos desafios e participe.</h3> 
                                <h4>Sua boa solução será compartilhada com a empresa e com headhunters.</h4>                                 
            </div>
            </div>
        </div>
    </header>   
   <hr>
 
            <hr>  
     <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-6">
                        <h3>CONTATO</h3>
                        <p class="lead">mendl@mendl.com.br</p>
                        <i class="fa fa-linkedin-square fa-2x"></i>
                        <i class="fa fa-facebook-square fa-2x"></i>                        
                    </div>
                       <div class="footer-col col-md-6">
                        <h3>Sobre a Mendl CrowdCaseSolution</h3>
                        <p>A Mendl CrowdCaseSolution é uma divisão da Mendl Gestão de Ensino a Distância que une Talentos, Universidades, Empresas e HeadHunteres para a solução de desafios reais de empresas e melhora o processo de seleção de pessoas.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Mendl 2015
                    </div>
                </div>
            </div>
        </div>  
    </footer>    
    </div>    
    </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="js/scrolling-nav.js"></script>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    </body>
</html>
