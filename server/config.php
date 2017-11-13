<?php 
require_once(dirname(__FILE__)."/variables.php");	
$mysqli = new mysqli(SERVERNAME,USERNAME,PASSWORD,DBNAME);	
// Check connection	
if ($mysqli->connect_errno)	{	  	
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;	  	
    exit();	
}
?>