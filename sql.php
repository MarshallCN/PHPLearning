<?php
	if(isset($_GET['tid'])) {
	$mysql = new PDO('mysql:host=localhost;dbname=test','root','');
		$tid = $_GET['tid'];
		$sql = "
		SELECT * FROM test_encry 
		WHERE id = :td
		LIMIT 1
		";
		$sta = $mysql->prepare($sql);
		$sta->execute([':td'=>$tid]);
		print_r($sta->fetch());
		//$res = $mysql->query($tid);
		//print_r($res->fetchobject());
	}
?>