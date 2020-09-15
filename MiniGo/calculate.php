<?php
/* $db = new PDO('mysql:host=localhost;dbname=test','root','');
$result = $db->query("SELECT * FROM goBoard");
while($row=$result->fetch()){
	
} */
session_start();
$playerGo = isset($_GET['goPlace'])? $_GET['goPlace']:null;
$playerX = $playerGo[0]-1;
$playerY = $playerGo[2]-1;
$_SESSION['board'][$playerX][$playerY] = 1;
$wins = array();
$wincount = 0;
$goScore=[];
for($i=0;$i<3;$i++){
	$wins[$i]=[];
	$goScore[$i]=[];
	for($j=0;$j<3;$j++){
		$wins[$i][$j]=[];
		$goScore[$i][$j]=0;
	}
}
for($i=0;$i<3;$i++){
	for($j=0;$j<3;$j++){
		$wins[$i][$j][$wincount]=true;
	}
	$wincount++;
}
for($i=0;$i<3;$i++){
	for($j=0;$j<3;$j++){
		$wins[$j][$i][$wincount]=true;
	}
	$wincount++;
}
for($i=0;$i<3;$i++){
	$wins[0+$i][0+$i][$wincount]=true;
}
$wincount++;
for($i=0;$i<3;$i++){
	$wins[0+$i][2-$i][$wincount]=true;
}
$wincount++; //8

if(!isset($_SESSION['aiWin'])){
	$_SESSION['aiWin']=[];
	for($i=0;$i<$wincount;$i++){
			$_SESSION['aiWin'][$i]=0;
		}
}
if(!isset($_SESSION['hmWin'])){
	$_SESSION['hmWin']=[];
	for($i=0;$i<$wincount;$i++){
		$_SESSION['hmWin'][$i]=0;
	}	
}
for($k=0;$k<$wincount;$k++){
	if(isset($wins[$playerX][$playerY][$k])){
		$_SESSION['hmWin'][$k]++;
		//$_SESSION['aiWin'][$k]--;
		if($_SESSION['hmWin'][$k]>3){
			echo "<script>alert('You win');</script>";
			session_destroy();
		}
	}
}
$maxScore=0;
for($i=0;$i<3;$i++){
	for($j=0;$j<3;$j++){
		if($_SESSION['board'][$i][$j]==0){
			for($k=0;$k<$wincount;$k++){
				if(isset($wins[$i][$j][$k])){
					if($_SESSION['aiWin'][$k] == 1){
						$goScore[$i][$j] += 1;
					}else if($_SESSION['aiWin'][$k] == 2){
						$goScore[$i][$j] += 15;
					}
					if($_SESSION['hmWin'][$k] == 1){
						$goScore[$i][$j] += 1;
					}else if($_SESSION['hmWin'][$k] == 2){
						$goScore[$i][$j] += 10;
					}else if($_SESSION['hmWin'][$k] == 0){
						$goScore[$i][$j] += 1;
					}
				}
			}	
			if($goScore[$i][$j]>$maxScore){
				$maxScore=$goScore[$i][$j];
				$u=$i;
				$v=$j;
			}
		}
	}
}
$_SESSION['board'][$u][$v]=2;
for($k=0;$k<$wincount;$k++){
	if(isset($wins[$u][$v][$k])){
		$_SESSION['aiWin'][$k]++;
		if($_SESSION['aiWin'][$k]>3){
			echo "<script>alert('You lose');</script>";
			session_destroy();
		}
	}
}
echo ($u+1)."_".($v+1);
//print_r($_SESSION['aiWin']);

?>