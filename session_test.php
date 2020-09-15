<?php
session_start();
$_SESSION['jspt']="
<script>document.getElementById('orange').selected=true;
document.getElementById('t1').value=222;
</script>";
?>
<a onclick='go()'>session_show.php</a>
<script>
	function go(){
		window.location.href='session_show.php';
	}
</script>
<BR/>
<button type='submit'>button</button>

<form  method='post'>
	<button name='123' onclick ="history.back(-1);" outline>Modify</button>
</form>
<?php
	if(isset($_POST['123'])){
		echo "<script>alert('123')</script>";
	}
			
?>