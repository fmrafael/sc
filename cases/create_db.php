<?php 
//mysql configuration
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "102030";
$mysql_database = "mendl_challenge";

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'config.php';		
//create table casesolutions
mysqli_query($conn,"CREATE TABLE casesolutions (
		ID_caseSolution INT PRIMARY KEY AUTO_INCREMENT,
		created DATETIME,
		id_linkedin VARCHAR(10),
		caseSolution TEXT,
		ID_case INT
)
		DEFAULT CHARSET utf8 COLLATE utf8_unicode_ci ENGINE InnoDB")
		or die(mysqli_error($conn));
// first input petro_case
mysqli_query($conn,"INSERT INTO cases (companyName,caseTitle,caseDescription) 
		VALUES ('Petrobras S.A','Como resgatar a confiança dos investidores e retomar o
		crescimento?', 
		'Após a forte expansão da empresa ocorrida a partir de 2000, atribuída, entre outros fatores, à descoberta de grandes reservas de petróleo em águas profundas (pré-sal), a empresa atingiu o seu maior valor de mercado em 2008, R$ 510 bilhões, tornando-se uma das maiores empresas do mundo.
O futuro da companhia era promissor. Grandes reservas de petróleo foram descobertas, o marco regulatório do pré-sal garantiu a Petrobras participação de, no mínimo, 30% na exploração de todas as novas áreas descobertas que seriam concedidas para a exploração da iniciativa privada. Para implementação de seus projeto, a Companhia captou R$ 120 bilhões na Bolsa de Valores, o que foi considerado o maior IPO da história na época. 
A empresa tinha atingido o seu auge, mas não conseguiu entregar nos anos seguintes aquilo que prometera aos seus acionistas. Os resultados não vieram. O excesso de projetos em execução, o controle de preços da gasolina exercido pelo Governo (comprava por um preço mais caro do que estava autorizada a vender no mercado nacional), dentre outros fatores, acabaram comprometendo o caixa da Companhia. 
Era apenas o início do agravamento da crise dentro da Petrobras. Começaram a aparecer denúncias de irregularidades em algumas obras em 2012, tendo sido deflagrado em 2014, por meio da Operação Lava Jato da Polícia Federal. O valor de mercado da Companhia despencou para menos de 30% do que fora em seu auge.
A credibilidade da Companhia está em xeque. Os principais problemas a serem enfrentados são: não entrega do balanço de 2014, dada dificuldade em reconhecer o valor da corrupção no balanço com  possibilidade de vencimentos antecipados de dívidas; atraso no fluxo de pagamentos  a fornecedores e bloqueio de investimentos; impossibilidade de emitir dividas e alongar o caixa; ausência de governança e compliance; troca de comando; redução de dividendos aos acionistas.')")
or die(mysqli_error($conn));
//create table cases
mysqli_query($conn,"CREATE TABLE cases (
		ID_case INT PRIMARY KEY AUTO_INCREMENT,
		companyEmailAddress VARCHAR(25),
		companyName VARCHAR(50) CHARSET utf8,
		caseTitle TEXT CHARSET utf8,
		caseDescription TEXT CHARSET utf8,
		created DATETIME, companyLogo VARCHAR(50) CHARSET utf8)
		DEFAULT CHARSET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB")
		or die(mysqli_error($conn));

//create table users
mysqli_query($conn,"CREATE TABLE users (
		ID_user INT PRIMARY KEY AUTO_INCREMENT,
		created DATETIME,
		id_linkedin VARCHAR(10),
		formattedName VARCHAR(25),
		numConnections INT,
		pictureUrl VARCHAR(100),
		publicProfileUrl VARCHAR(100),
		emailAddress VARCHAR(50),
		location VARCHAR(25),
		positionsTitle VARCHAR(100)
)
		DEFAULT CHARSET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB")
		or die(mysqli_error($conn));
?>