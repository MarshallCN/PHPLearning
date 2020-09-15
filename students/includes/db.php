<?php
	
$username = "root";
$password = "";
$hostname = "localhost";
$dbname = 'my_test';
//connection to the database
$db = mysqli_connect($hostname, $username, $password, $dbname)
	
//select a database to work with
// $database = mysql_select_db("test", $db) or die("Could not select sis");
	
?>