<?php
header("Content-type:text/html;charset=utf-8");
$conn = mysql_connect("localhost","root","0618");
mysql_select_db('test',$conn);
mysql_query("set names utf8");
$re= mysql_query("select * from test1");
?>
<table border='1px'>
<th colspan="2">Food</th>
<tr>
<td>id</td><td>name姓名</td>
</tr>
<?php 
while($row=@mysql_fetch_row($re)){
?>
<tr>
<td><?php echo $row[0];?></td><td><?php echo $row[1];?></td>
</tr>
<?php
}    
?>
</table>
