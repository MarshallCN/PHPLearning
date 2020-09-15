<html>
  <head>
     <title>Bob's Auto parts - order results</title>
  </head>
  <body>
	<form>
	Select your favorite fruit:
	<select>
	<option id="apple">Apple</option>
	<option id="orange">Orange</option>
	<option id="pineapple" selected="selected">Pineapple</option>
	<option id="banana">Banana</option>
	</select>
	<input type='text' id='t1'>
<?php
	session_start();
	if(isset($_SESSION['jspt'])){
		echo $_SESSION['jspt'];
	}
	unset($_SESSION['jspt']);
?>

<?php
$a=array("Volvo"=>"XC90","BMW"=>"X5","Toyota"=>"Highlander");
print_r(array_keys($a));
?>
  </body>
</html>