<?php

//execute the SQL query and return records
$result = mysql_query("SELECT id, name, sex, phone FROM students");

?>

<a href="index.php?page=addstudent">Add student</a>
<br/><br/>

<table border="1">
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td>Sex</td>
		<td>Grades</td>
	</tr>

<?php
	
//fetch tha data from the database
while ($row = mysql_fetch_array($result)) {

?>	
	
	<tr>
		<td><?php echo $row{'id'}; ?></td>
		<td><a href="index.php?page=detail&id=<?php echo $row{'id'}; ?>"><?php echo $row{'name'}; ?></a></td>
		<td><?php echo $row{'sex'}; ?></td>
		<td><a href="index.php?page=grades&id=<?php echo $row{'id'}; ?>">grades</a></td>
		
	</tr>
	
<?php

}

mysql_close($db);
	
?>

</table>