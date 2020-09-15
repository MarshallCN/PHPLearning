<?php
$text="<br/>In the Mountain mode,<br/>You can stay at the \"<span id='red'>  * </span>\",<br/>but you cannot cross \"<span id='red'>  * </span>\".";
function Mountain() {
   function SetM($r,$c){
	    global $board;
		$board[$r][$c]="<span id='red'>  * </span>";
   }
   SetM(3,10);
   SetM(2,10);
   SetM(7,11);
   SetM(7,10);
   SetM(7,8);
   SetM(8,8);
}
Mountain();
?>







