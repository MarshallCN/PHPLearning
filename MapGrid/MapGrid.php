<!DOCTYPE html>
 <html>
   <head>
     <title>Map Grid</title>
	 <link type="text/css" rel="stylesheet" href="style.css" />
   </head>
   <body>
     <form action="MapGrid.php" method ="post">
        <br/><br/>
        <h1>Map Grid</h1>
		<div class="input"> 
	        <div class="start">
                <p><strong>Start</strong> Row:<input placeholder="Int" type="text" name="s1" style="height:24px;width:48px"/>Col:<input placeholder="Letter/Int" type="text" name="st" style="height:24px;width:64px"/></p>
	        </div>
	        <div class="end">
                <p><strong>End</strong> Row: <input placeholder="Int" type="text" name="e1" style="height:24px;width:48px"/>Col:<input placeholder="Letter/Int" type="text" name="et" style="height:24px;width:64px"/></p>
            </div>
		    <div class="submit">    
		       <input type="submit" name="submit" value="FlatGround" />
				<input type="submit" name="mountain" value="Mountain" />
	        </div>
		</div>
     </form>
	 <img src="img/Red.gif"/>
	 <div class="board">
     <?php
	    error_reporting(E_ALL^E_NOTICE^E_WARNING);
		$text="";
        $board= array(array(" -- ","  A ","  B ","  C ","  D ","  E ","  F ","  G ","  H ","  I ","  J ","  K ","  L ","  M "));
        for($i=1;$i< 12;$i++) {
	        array_push($board,array("0".$i,"  + ","  + ","  + ","  + ","  + ","  + ","  + ","  + ","  + ","  + ","  + ","  + ","  + "));
            if ($i >9) {
                $board[$i][0]= $i;
            }
        }
		if (isset($_POST['mountain'])) {
            require 'mountain.php';
	    }
        function board(){                                                                                   //Create Board
            global $board;
            for($i=0;$i < count($board);$i++) {
	            for($n=0;$n< count($board[$i]);$n++){
                    echo $board[$i][$n];
                    $len = count($board)+1;
                    if($n == $len) {
                      echo "<br/>";
                    }
	            }
            } 
        }
        $s1= $_POST["s1"];
        $sT= $_POST["st"];
        $e1= $_POST["e1"];
        $eT= $_POST["et"];
		function strorint($n){
                $text= array("A"=>1,"B"=>2,"C"=>3,"D"=>4,"E"=>5,"F"=>6,"G"=>7,"H"=>8,"I"=>9,"J"=>10,"K"=>11,"L"=>12,"M"=>13);
                if (is_numeric($n)== true){
                    return $n;
                }else{
	                $n= $text[strtoupper($n)];
	                return $n;
                }
            }                                                                                               //input change to numeric
        if($s1=="" && $sT=="" && $e1=="" && $eT==""){
			board();
	        echo "<p class='begin'>Row should be Int(1~11),<br/>Col should be Letter(A~M)<br/>$text</p>";   //Start View
        }else{                                        
            $s2= strorint($sT);
            $e2= strorint($eT);                                             
            if (is_numeric($s1)== true && is_numeric($e1)==true && is_numeric($s2) && is_numeric($e2)) {
	            $s1= (int)$s1;
	            $s2= (int)$s2;
	            $e1= (int)$e1;
	            $e2= (int)$e2;                                                                               //Make input int
	            if (($s1 <1|| $s2 <1 ||$e1< 1|| $e2<1)||($s1 >11 || $s2 >13 ||$e1 >11|| $e2 >13)){
					echo "<p class='out'>Notice: Out of Map</p>";                                            //Index out of Map?
	            }else if($s1== $e1 && $s2== $e2){
		            $board[$s1][$s2] ="<span id='yellow'>  S </span>";
					board();
					echo "<p class='home'>You're at home</p>";                                               //Same input?
	            }else{                                                                                       //Finished checking input
                    $board[$s1][$s2] ="<span id='yellow'>  S </span>";
                    $board[$e1][$e2] ="<span id='red'>  E </span>";                                          //Show the Start& End point
                    $board1 = $board;
					$board2 = $board;
					require 'clac.php';	
					$al1= new Calc($s1,$s2,$e1,$e2,$s2,$board1,$s1,$s2,$e1,$e2);
					$al1->calculate();
					$al2 = new Calc($e1,$e2,$s1,$s2,$e2,$board2,$s1,$s2,$e1,$e2);
					$al2->calculate();
					if ($al1->countr() < $al2->countr()) {
						$dist = $al1->countr();
						$al1->printb();
					}else if($al1->countr() > $al2->countr()){
						$dist = $al2->countr();
						$al2->printb();
					}else{
						$dist = $al1->countr();
						$al1->printb();
					}
                    echo "<p class='box'><strong>Start</strong> ($s1,$sT)<br/>";
                    echo "<strong>End</strong> ($e1,$eT)<br/>";
                    echo "<strong>Route: $dist</strong></p>";                                                 //Show the result
                }
            }else{
	            echo "<p class='warn'>Warning: Wrong Vaule!<br/> Row should be Int(1~11),<br/>Col should be Letter(A~M)</p>";
            }                                                                                                 //Wrong input display
        }
     ?>
	</div>
    </body>
</html>