<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "vendor/autoload.php";
$linkedIn=new Happyr\LinkedIn\LinkedIn('v3x1pj441nl9', '3ifR7tAuTKrzTUHH');
if ($linkedIn->isAuthenticated()) {
	//we know that the user is authenticated now. Start query the API
	$user=$linkedIn->api('v1/people/~:(firstName,lastName,headline,location,num-connections,summary,specialties,positions,picture-url,public-profile-url,email-address,date-of-birth,educations,num-recommenders)');	
	echo "Welcome ".$user['firstName'] .$user['lastName'] .$user['location']['name'] ;
	
	exit();
	
} elseif ($linkedIn->hasError()) {
	echo "User canceled the login.";
	exit();
}
//if not authenticated
$url = $linkedIn->getLoginUrl(array(
		redirect_uri => 'http://6e34f295.ngrok.com/cases/auth.php'));

header("Location: " . $url);


?>