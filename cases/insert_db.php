<?php 
//mysql configuration
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "102030";
$mysql_database = "mendl_challenge";

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'config.php';		

mysqli_query($conn,"INSERT INTO cases (companyName,caseTitle,caseDescription,processSelection) 
		VALUES ('Case-teste','Como ampliar as vendas?', 
		'Teste.', '#RED23456')") or die(mysqli_error($conn));

?>