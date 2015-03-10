<?php 

//mysql configuration
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "102030";
$mysql_database = "mendl_challenge";

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once "vendor/autoload.php";
$linkedIn=new Happyr\LinkedIn\LinkedIn('v3x1pj441nl9', '3ifR7tAuTKrzTUHH');
if ($linkedIn->isAuthenticated()) {
	//we know that the user is authenticated now. Start query the API
	$user=$linkedIn->api('v1/people/~:(id,formattedName,numConnections,pictureUrl,publicProfileUrl,emailAddress)');	
	echo "Welcome ".$user['id'] .$user['formattedName'] .$user['publicProfileUrl'];	
	$conn = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}	
	// Get variables api and insert in database
	
	
	$sql = "INSERT INTO users (id_linkedin,formattedName,numConnections,pictureUrl,publicProfileUrl,emailAddress) VALUES('$user[id]','$user[formattedName]','$user[numConnections]','$user[pictureUrl]','$user[publicProfileUrl]','$user[emailAddress]')";
	
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		exit();			
	
		
	
			
}
elseif ($linkedIn->hasError()) {
	echo "User canceled the login.";
	exit();
}
//if not authenticated
$url = $linkedIn->getLoginUrl(array(
		redirect_uri => 'http://3737234d.ngrok.com/cases/auth.php'));

header("Location: " . $url);


?>