<!DOCTYPE html>
<html>
<head>
<title></title>

</head>
<body>
<?php
$a=12;
$b='12';
?>
<p>TEST1</p>
<?php 
  echo $a.'<br/>';
  echo $b.'<br/>';
  echo "$a".'<br/>';
  echo "$b".'<br/>';
  echo "'$a'".'<br/>';
  echo "'$b'".'<br/>';
?>

<p>TEST2</p>
<input type='text' maxlength='6' value=<?php echo $a;?>/>
<input type='text' maxlength='6' value=<?php echo $b;?>/>
<input type='text' maxlength='6' value=<?php echo "$a";?>/>
<input type='text' maxlength='6' value=<?php echo "$b";?>/>
<input type='text' maxlength='6' value=<?php echo "'$a'";?>/>
<input type='text' maxlength='6' value=<?php echo "'$b'";?>/>

</body>
</html>
</center>
</body>
</html>