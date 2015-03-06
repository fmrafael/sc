<?php 

require('lib/http.php');
require('lib/oauth_client.php');

$client->server = 'LinkedIn';
$client->redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].
dirname(strtok($_SERVER['REQUEST_URI'],'?')).'/linkedin.php';
$client->client_id = 'v3x1pj441nl9';
$application_line = __LINE__;
$client->client_secret = '3ifR7tAuTKrzTUHH';

$client->scope = 'r_fullprofile r_emailaddress';

?>