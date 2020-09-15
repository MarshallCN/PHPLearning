<?php
	
if (isset($_POST['name']) && isset($_POST['sex']) && isset($_POST['phone'])) {
	$name = $_POST['name'];
	$sex = $_POST['sex'];
	$phone = $_POST['phone'];
	
	//execute the SQL query and return records
	$sql = "INSERT INTO students (name, sex, phone) VALUES ('$name', '$sex', '$phone')";
	
	$result = mysql_query($sql) or die(mysql_error());
	
	/*
	if (mysql_query($sql)) {
	    echo "New student created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $db->error;
	}
	*/

	mysql_close($db);	
}
	
?>

<h1>Add a student</h1>

<form action="index.php?page=addstudent" method="post">
Name:  <input type="text" name="name"><br>
Sex:   <input type="text" name="sex"><br>
Phone: <input type="text" name="phone"><br>
<input type="submit">
</form>