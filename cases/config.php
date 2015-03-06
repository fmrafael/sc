<?php 
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "102030";
$mysql_database = "mendl_challenge";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");
$base_url='http://6e34f295.ngrok.com/';

?>