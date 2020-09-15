<?php
	
require("includes/db.php");	

$id = $_GET['id'];

//execute the SQL query and return records
$result = mysql_query("SELECT id, name, sex, phone FROM students WHERE id = $id");	

while ($row = mysql_fetch_array($result)) {

echo $row{'id'};
echo $row{'name'};
echo $row{'sex'};
	
}

mysql_close($db);
	
?>