<?php session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'config.php';

$companyEmailAddress = $_POST['company_emailAddress'];
$companyName = $_POST['companyName'];
$caseTitle = $_POST['caseTitle'];
$caseDescription = $_POST['caseDescription'];
$dt = date("Y-m-d H:i:s");

$submitCase = mysqli_query($conn,
		"INSERT INTO cases (company_emailAddress,companyName,caseTitle,caseDescription)
		VALUES('$companyEmailAddress','$companyName','$caseTitle','$caseDescription''$dt')") 
		or die(mysqli_error($conn));
echo "Obrigado por incluir mais este Desafio. Iremos analisar e publicar.";
header("refresh:3;crowdcasesolution.html");
?>