<?php
	function inputCheck($input){
		$input=mysql_real_escape_string(htmlspecialchars($input));
		return $input;
	}
	if(isset($_GET['id'])){
		$id = inputCheck($_GET['id']);
		$mysql = new PDO('mysql:host=localhost;dbname=test','root','0618');
		$sql = "SELECT * FROM test1 WHERE id = '$id'";
		$res = $mysql->query($sql);
		$row = $res->fetch();
		echo $row[0];
	}
	if(isset($_POST['s'])){
		echo $_POST['s'];
	}
	if(isset($_GET['s'])){
		echo $_GET['s'];
	}
	//echo nl2br(strip_tags("<p class='text-center'><b>Hello World</b></p>tlksa jlkdsa f f salkf j32432432fefewf wefwfewfe wfewf <p class='text-right'><i><u>ee</u>wwe1</i></p>","<p><b><u><i>"));
	$salt=base64_encode(mcrypt_create_iv(6,MCRYPT_DEV_RANDOM));  
	//$password=sha1($register_password.$salt);  
	echo $salt;

?>

<form method='post'>
	<input type='text' name='s'/>
	<input type='submit'/>
</form>