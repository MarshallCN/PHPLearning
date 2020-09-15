<div style='text-align:center'>
	<h1>Login in</h1>
	<form action='' method='post'>
		Username <input type='text' name='user' maxlength=20 required/>
		Password <input type='password' name='pwd' maxlength=20 required/><br/><br/>
		<input type='submit' name='submit' value='Submit' style='border-radius:10px;'/>
	</form>
<script>
	var changeStyle = function(name,color){
		var ele = document.getElementsByName(name)[0];
		ele.style.border='0px';
		ele.style.boxShadow='0px 0px 10px'+color;
	};
</script>
<?php
session_start();
	if(isset($_POST['submit'])){
		$user = $_POST['user'];
		$pwd = $_POST['pwd'];
		$mysql = new PDO('mysql:host=localhost;dbname=test', 'root', '');
		$sql = "SELECT pwd FROM user WHERE name = :user";
		$pre = $mysql->prepare($sql);
		$pre->execute([':user'=> $user]);
		$pwd = $pre->fetchColumn();
	echo "<script>document.getElementsByName('user')[0].value='{$_POST['user']}';document.getElementsByName('pwd')[0].value='{$_POST['pwd']}';</script>";
		if(!empty($pwd)){
			if($_POST['pwd'] == $pwd){
				echo "Login Success";
				echo "<script>changeStyle('user','#0a8754');changeStyle('pwd','#0a8754');</script>";
				$_SESSION['user'] = $user;
			}else{
				echo "Wrong Password";
				echo "<script>changeStyle('pwd','#DD041A');changeStyle('user','#0a8754');</script>";
			}
		}else{
			echo "Username not found";
			echo "<script>changeStyle('user','#DD041A');</script>";
		}
	}
	if(isset($_SESSION['user'])){
		header("Location:dice.php");
	}
?>
</div>