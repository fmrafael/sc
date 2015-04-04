<?php session_start();


error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'config.php';
//selects case

$select_cases="SELECT * FROM cases";
$result=mysqli_query($conn, $select_cases);


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
					<li>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Full Width Image Header -->
	<header>
<div class="container">
<div class="col-lg-12">
<div class="page-header">
<h1>Selecione um Desafio!</h1>
<h4>Cada Desafio realizado permite ao talento ganhar prêmios e, claro, a oportunidade de apoiar uma empresa e se diferenciar no mercado.</h4>
</div>		
		</div>
		<div class="row">
		<div class="col-lg-12">
		</div>
		</div>
		<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
		  <div class="input-group">
		  <span class="input-group-addon"><span><i class="fa fa-search"></i></span>
                                </span>
		<input type="search" id="search" value="" class="form-control" placeholder="Pesquisar Desafio">
		</div>
		</div>
		</div>
		<div class="row">
		<div class="col-lg-12">
		<table class="table" id="table">
		
		<?php 

		echo "<table class='table table-striped table-hover'>
		 		
		<tr>
		<th>Empresa</th>
		<th>Desafio</th>
		<th>Competências</th>
		<th>Processo Seletivo</th>
		<th></th>
		</tr>";
while ($row = mysqli_fetch_array($result)) { 
	
echo "<tr>";
echo "<td>" .$row['companyName']. "</td>";
echo "<td>" .$row['caseTitle']. "</td>";
echo "<td>" .'#50pontos#negociação#estratégia#'. "</td>";
echo "<td>" .$row['processSelection']. "</td>";
echo "<td><a href=\"edit.php?id=" . $row['ID_case'] . "\">" . "Resolver" . "</a></td>";

"</tr>"; 
}
echo "</table>";
?>
		</table>
		<hr>
		</div>
		</div>
					
		</header>
		<script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
<script>
		$(function () {
    $( '#table' ).searchable({
        striped: true,
        oddRow: { 'background-color': '#f5f5f5' },
        evenRow: { 'background-color': '#fff' },
        searchType: 'fuzzy'
    });
    
    $( '#searchable-container' ).searchable({
        searchField: '#container-search',
        selector: '.row',
        childSelector: '.col-xs-4',
        show: function( elem ) {
            elem.slideDown(100);
        },
        hide: function( elem ) {
            elem.slideUp( 100 );
        }
    })
});


		(function ($) {
		    $.fn.extend({
		        tableAddCounter: function (options) {

		            // set up default options 
		            var defaults = {
		                title: '#',
		                start: 1,
		                id: false,
		                cssClass: false
		            };

		            // Overwrite default options with user provided
		            var options = $.extend({}, defaults, options);

		            return $(this).each(function () {
		                // Make sure this is a table tag
		                if ($(this).is('table')) {

		                    // Add column title unless set to 'false'
		                    if (!options.title) options.title = '';
		                    $('th:first-child, thead td:first-child', this).each(function () {
		                        var tagName = $(this).prop('tagName');
		                        $(this).before('<' + tagName + ' rowspan="' + $('thead tr').length + '" class="' + options.cssClass + '" id="' + options.id + '">' + options.title + '</' + tagName + '>');
		                    });

		                    // Add counter starting counter from 'start'
		                    $('tbody td:first-child', this).each(function (i) {
		                        $(this).before('<td>' + (options.start + i) + '</td>');
		                    });

		                }
		            });
		        }
		    });
		})(jQuery);

		$(document).ready(function () {
		    $('.table').tableAddCounter();
		    $.getScript("http://code.jquery.com/ui/1.9.2/jquery-ui.js").done(function (script, textStatus) { $('tbody').sortable();$(".alert-info").alert('close');$(".alert-success").show(); });
		});
		</script>

</body>
</html>
		