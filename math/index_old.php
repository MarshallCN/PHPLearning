<?php
	
	//learn from experience
	//edit itself
	
	$ary=['0','1','2','3','4','5'];
	
	$user = rand(0,5);
	
	/* for($i=0;$i<30;$i++){
		$random_me=$ary[$me];
		if($random_me > $answer_user){
			$me--;
			echo 'me-1 <br/>';
		}else if($random_me < $answer_user){
			$me++;
			echo 'me+1 <br/>';
		}else if($random_me == $answer_user){
			echo "Answer: $random_me<br>";
			echo "Index_user: $user";
			break;
		}
	} */
	echo "User(index): $user<br>";
for($i=0;$i<100;$i++){
	$me = mt_rand(0,5);
	if($ary[$me] != 'x'){
		echo "Index_me: $me<br>";
		if($ary[$me] != $ary[$user]){
			$ary[$me] = 'x';
			print_r($ary);
			echo '<br><br>';
		}else{
			echo "<br>Great!<br>";
			echo "Answer: $user=>$ary[$user]<br>";
			break;
		}
	}
}
?>
<div>
	<div style="background:#333;width:60px;height:60px;border-radius:100%;margin-left:15px;margin-top:10px;"></div>
	<div id='icons' style="height:120px;width:90px;border-top:60px solid #333;border-radius:45%;position:absolute;"></div>
</div>
