<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);
	
require("includes/db.php");

include("header.php");

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 'default';
}

if ($page == 'default') {
	include("students.php");

} else if ($page == 'detail') {
	include("details.php");
	
} else if ($page == 'grades') {
	include("grades.php");
	
} else if ($page == 'addstudent') {
	include("addstudent.php");
	
} else {
	require("students.php");
}

include("footer.php");








	
?>