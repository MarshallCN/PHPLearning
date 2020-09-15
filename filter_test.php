<?php
function test_odd($var)
{
return(~ $var & 1);
}

$a1=array("a","b",2,3,4,5,6,7,8,19,11,'21','244',332,0,'0102');
//print_r(array_filter($a1,"test_odd"));

?>