<html>
    <head>
        <title>MiniGo</title>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
    </head>
    <body>
		<div class="container">
			<div class="board">
				<div class="grey_block"><span id="1_1"></span></div>
				<div class="white_block"><span id="1_2"></span></div>
				<div class="grey_block"><span id="1_3"></span></div>
				<div class="white_block"><span id="2_1"></span></div>
				<div class="grey_block"><span id="2_2"></span></div>
				<div class="white_block"><span id="2_3"></span></div>
				<div class="grey_block"><span id="3_1"></span></div>
				<div class="white_block"><span id="3_2"></span></div>
				<div class="grey_block"><span id="3_3"></span></div>
			</div>
			<form method="get">
				<span class="circle_go" id="circle_start" onclick="document.getElementsByName('circle_start')[0].click();"></span>
				<span class="cross_go" id="cross_start" onclick="document.getElementsByName('cross_start')[0].click();"></span>
				<input type="submit" name='circle_start' style="display:none"/>
				<input type="submit" name='cross_start' style="display:none"/>
			</form>
		</div>
		<input type="hidden" id="whofirst" value="circle_go"/>
		<?php
			session_start();
			if(isset($_GET['cross_start'])){
				$playerSign="cross";
				echo "You are CROSS!";
				echo "<script>document.getElementById('whofirst').value='cross_go';</script>";
			}else{
				$playerSign="circle";
				echo "You are CIRCLE!";
			}
			$_SESSION['board'] = array([0,0,0],[0,0,0],[0,0,0]);//0 is empty,1 is human, 2 is ai
		?>
		<script>
			whofirst = document.getElementById('whofirst').value;
			blocks = document.getElementsByClassName('board')[0].childNodes;
			stepNum = 0;
			function sendData(i){
				blocks[i].onclick=function(){
					this.firstChild.className=whofirst;
					this.onclick='';
					stepNum++;
					/* if(stepNum>=5){
						alert('finish');
					} could write in PHP*/
					this.firstChild.style.cursor="default";
					var request = new XMLHttpRequest();
					request.open("GET", 'calculate.php?goPlace=' + this.firstChild.id, true);
					request.send();
					request.onreadystatechange = function() {
						if (request.readyState===4){
							if(request.status===200){
								aiGo = (whofirst=="circle_go")? "cross_go":"circle_go";
								alert(request.responseText);
								aiPlace = document.getElementById(request.responseText);
								if(aiPlace.parentNode.onclick!==null){
									aiPlace.className=aiGo;
									aiPlace.parentNode.onclick='';
									aiPlace.parentNode.style.cursor="default";
								}
							} else {
								alert("Error:" + request.status);
							}
						} 
					};
				};
				
			}
			for(var i=1;i<blocks.length;i+=2){
				sendData(i);
			}
		</script>
    </body>
</html>