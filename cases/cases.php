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
$ID_case = '1';
$_SESSION['ID_case'] = $ID_case;
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
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"
	rel="stylesheet">
<link rel="stylesheet"
	href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link
	href='http://fonts.googleapis.com/css?family=Open+Sans:800,400,600'
	rel='stylesheet' type='text/css'>
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
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a class="navbar-brand" href="cases/index"><i class="fa fa-star"></i>
							Mendl CrowdCaseSolution</a>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-brand">
					<li><?php echo  $_SESSION['formattedName'] ?>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Full Width Image Header -->
	<header>
		<div class="container">
			<div class="row bs-wizard" style="border-bottom: 0;">
				<div class="col-xs-4 bs-wizard-step complete">
					<!-- complete -->
					<div class="text-center bs-wizard-stepnum">
						<i class="fa fa-trophy"></i> 1°Etapa
					</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<div class="bs-wizard-dot"></div>
				</div>
				<div class="col-xs-4 bs-wizard-step active">
					<!-- complete -->
					<div class="text-center bs-wizard-stepnum">
						<i class="fa fa-trophy"></i><i class="fa fa-trophy"></i> 2°Etapa
					</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<div class="bs-wizard-dot"></div>
					<div class="bs-wizard-info text-center">Solucione o Desafio da
						Empresa</div>
				</div>
				<div class="col-xs-4 bs-wizard-step disabled">
					<!-- active -->
					<div class="text-center bs-wizard-stepnum">
						<i class="fa fa-trophy"></i><i class="fa fa-trophy"></i><i
							class="fa fa-trophy"></i> 3°Etapa
					</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<div class="bs-wizard-dot"></div>
					<div class="bs-wizard-info text-center">Solução compartilhada com o
						Mercado de Trabalho</div>
				</div>
			</div>
		</div>
		<hr>
		<?php 
		$query = mysqli_query($conn,"SELECT * FROM cases WHERE ID_case='$ID_case'");
		while ($caseDesc = mysqli_fetch_array($query)){
			?>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="box">
						<div class="box-icon">
							<span class="fa fa-4x fa-cubes"></span>
						</div>
						<div class="info">
							<h4 class="text-center">
								Desafio
								<strong><?php echo $caseDesc['companyName'];?></strong>
							</h4>
							<h4 class="text-center">
								<?php echo $caseDesc['caseTitle'];?>
							</h4>
							<p>
								<?php echo $caseDesc['caseDescription'];?>
							</p>
							<?php }?>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="box">
						<div class="box-icon">
							<span class="fa fa-4x fa-exclamation"></span>
						</div>
						<div class="info">
							<form method="POST" action="form_solution.php">
								<h4 class="text-center">Sua Solução</h4>
								<textarea name="caseSolution" id="caseSolution"
								class="form-control" rows="9" cols="60"
								placeholder="Você tem 15 minutos."></textarea>
								<span class="timer" id="timer"></span> '' <i class="fa fa-bomb"></i>								
								<button type="submit" class="btn btn-link">Enviar</button>
							</form>
		</div>
	</header>
	<hr>
	<footer class="text-center">
		<div class="footer-above">
			<div class="container">
				<div class="row">
					<div class="footer-col col-md-6">
						<h3>CONTATO</h3>
						<p class="lead">mendl@mendl.com.br</p>
						<i class="fa fa-linkedin-square fa-2x"></i> <i
							class="fa fa-facebook-square fa-2x"></i>
					</div>
					   <div class="footer-col col-md-6">
                        <h3>Sobre a Mendl CrowdCaseSolution</h3>
                        <p>A Mendl CrowdCaseSolution é uma divisão da Mendl Gestão de Ensino a Distância que une Talentos, Universidades, Empresas e HeadHunteres para a solução de desafios reais de empresas e para melhorar o processo de seleção de pessoas.</p>
                    </div>
				</div>
			</div>
		</div>
		<div class="footer-below">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">Copyright &copy; Mendl 2015</div>
				</div>
			</div>
		</div>
	</footer>
	</div>
	</div>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script src="js/scrolling-nav.js"></script>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>		
		<script type="text/javascript">
		var count=900;
		var minutes = Math.floor(count / 60);
		var counter=setInterval(timer, 1000); //1000 will  run it every 1 second
		function timer()
	{
	  count=count-1;
	  if (count <= 0)
	  {
	     clearInterval(counter);
	     return;
	  }
	 document.getElementById("timer").innerHTML=count; // watch for spelling
	}
		</script>
	</body>
</html>
