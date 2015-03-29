<?php session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "vendor/autoload.php";
require_once "config.php";

$linkedIn=new Happyr\LinkedIn\LinkedIn('v3x1pj441nl9', '3ifR7tAuTKrzTUHH');
if ($linkedIn->isAuthenticated()) {	
	$user  =  $linkedIn->api('v1/people/~:(id,formattedName,numConnections,pictureUrl,publicProfileUrl,emailAddress,location,positions)');					
	$share = $linkedIn->api('v1/people/~/shares',array ('format' => 'json'),'POST', array(
			'content' => array('title' => 'Mendl CrowdCaseSolution',
								'description' => 'Resolva Cases de Empresas Reais e turbine seu currículo!',
								'submitted-url' => 'https://mendl.com.br/cases/linkedin'),
			'comment' => 'Acessei a Mendl com meu login do linkedin e resolvi mais um DESAFIO real de uma empresa.',
			'visibility' => array('code' => 'anyone' )
	)
	);
	$_SESSION['id_linkedin'] = $user['id'];
	$_SESSION['formattedName'] = $user['formattedName'];		
		$dt = date("Y-m-d H:i:s");
		$InsertUser = "INSERT INTO users2 (id_linkedin,
		formattedName,numConnections,pictureUrl,publicProfileUrl,emailAddress,created)
		VALUES('$user[id]','$user[formattedName]','$user[numConnections]',
		'$user[pictureUrl]','$user[publicProfileUrl]','$user[emailAddress]','$dt')";
		$return = "SELECT * FROM users2 WHERE emailAddress LIKE '$user[emailAddress]'";
		$res = mysqli_query($conn,$return);		
		if (mysqli_num_rows($res) >0){						
			header("Location: cases.php");			
		}
	//Creates record	
		elseif (mysqli_query($conn, $InsertUser)) {
			header("Location: cases.php");
		} else {
			echo "Error: " . $InsertUser . "<br>" . mysqli_error($conn);
		}
		exit();			
		
}elseif ($linkedIn->hasError()) {
	echo "User canceled the login.";
	exit();
}
//if not authenticated
$url = $linkedIn->getLoginUrl(array(
		redirect_uri => 'http://5a2eaca7.ngrok.com/cases/auth.php'));
header("Location: " . $url);
?>