<?php session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'config.php';

$caseSolution = $_POST['caseSolution'];
$_SESSION['ID_case'];
$dt = date("Y-m-d H:i:s");

$submitCase = mysqli_query($conn,
		"INSERT INTO casesolutions (id_linkedin,caseSolution,ID_case,created)
		VALUES('$_SESSION[id_linkedin]','$caseSolution','$_SESSION[ID_case]','$dt')") 
		or die(mysqli_error($conn));
header("Location: finished.php");
?>