<?php

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	// Select grades from 1 student
	$result = mysql_query("SELECT id, student_id, subject_name, grade FROM grades WHERE student_id = $id");
	
} else {
	// Show grades form all students
	$result = mysql_query("SELECT id, student_id, subject_name, grade FROM grades");
}	
	
?>

<table border="1">
	<tr>
		<td>ID</td>
		<td>Student_id</td>
		<td>Subject_name</td>
		<td>Grade</td>
	</tr>

<?php	

	if (mysql_num_rows($result) == 0) {
		echo "<tr>";
		echo "<td colspan=4>No grades found.</td>";
		echo "</tr>";
		
	} else {
		while ($row = mysql_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row{'id'} . "</td>";
			echo "<td>" . $row{'student_id'} . "</td>";
			echo "<td>" . $row{'subject_name'} . "</td>";
			echo "<td>" . $row{'grade'} . "</td>";
			echo "</tr>";
		}
	}

?>
</table>

<?php
	mysql_close($db);
?>