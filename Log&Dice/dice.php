<html>
<head>
<title>Dice Game</title>
</head>
<script>
var addTimes = 0;
function add(){
	var newName = document.getElementsByTagName('input')[0].cloneNode();
	newName.value = '';newName.style.marginRight = '6px';
	var br = document.createElement('BR');
	document.getElementById("inputName").appendChild(newName);
	addTimes++;
	if(addTimes%3==0){document.getElementById("inputName").appendChild(br);}
	if (addTimes > 5){
		document.getElementById('addP').disabled = true;
		alert('You can only add 9 Players!');
	}
}
</script>
<body>
<center>
<h1>Dice Game</h1>
<div>
	<form method='get' action=''>
	<div id='inputName'>
		<input type='text' name='player[]' placeholder='Input name' />
		<input type='text' name='player[]' placeholder='Input name'/>
		<input type='text' name='player[]' placeholder='Input name'/><br/>
	</div><br/>
		<input type='button' id='addP' value='Add Players' onclick='add()'/><br/>
		<p>Dice number from 0 to <input type='number' name='max' value=10 min=0 max=100 /></p>
		Single Winner<input type='radio' name='diceType' value='1' checked='true' />
		Multiple Winner<input type='radio' name='diceType' id='mw' value='0'/><br/>
		<input type='submit' value='Submit'/><br/><br/>
		<input type='submit' name='logout' value='Logout'/>
	</form>
</div>
<?php 
session_start();
if(isset($_GET['logout'])){
		echo 123;
	unset($_SESSION['user']);
	header("Location:login.php");
}
function Dice(){
	$players = array('Marshal','Johnny','Carry','Leo','Harry','Kevin','Toby'); //example
	//$players = array();
	if(isset($_GET['player'])){
		foreach($_GET['player'] as $playerName){
			if($playerName != ''){
				array_push($players,$playerName);
			} 
		}
	}
	if(isset($_GET['max'])){
		$max = $_GET['max'];
		echo "<script>document.getElementsByName('max')[0].value=$max;</script>";
	}else{
		$max=10;
	}
	$i = 0;
	$size = count($players);
	$highscore = -1;
	if(!isset($_GET['diceType'])){
		$diceType = 1;
	}else{
		$diceType = $_GET['diceType'];
		if($diceType==0){
			echo "<script>document.getElementById('mw').checked='true';</script>";
		}
	}
	switch($diceType){
	case 1:
		$Numbers = range(0,$max);
		while($i < $size){	//Unique Number
			$randIndex = rand(0,count($Numbers)-1); 
			if($Numbers[$randIndex] != ''){
				$randNum = $Numbers[$randIndex];
				$Numbers[$randIndex] = '';
				echo $players[$i].'&nbsp'.$randNum.'<br/>';
				if($randNum > $highscore){
					$highscore = $randNum;
					$winner = $players[$i];
				}
			}else{$i--;}
			//print_r($Numbers);
			$i++;	
		}
		break;
	case 0:
		while($i<$size){	//number can be same 
			echo $players[$i].'&nbsp';
			$random = rand(0,$max);
			echo $random.'<br/>';
			if($random > $highscore){
				$highscore = $random;
				$winner = $players[$i];
			}else if($random == $highscore){
				$winner .= ' and '.$players[$i];
			}
			$i++;
		}
		break;
	}
	if(isset($winner)){
		echo "<h3>The winner is <span style='color:red;'>$winner<span></h3>";
		echo "<input type='submit' name='again' value='Try again?' onclick='window.location.reload()' />";
	}
}
Dice();
?>

</center>
</body>
</html>