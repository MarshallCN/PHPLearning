<html>
<head>
<title>浏览表中记录</title>
</head>
<body>
<center>
<?php
header("Content-type:text/html;charset=gbk");
$conn = mysql_connect("localhost","root","0618")or die("Cannot connect to server!".mysql_error());;
mysql_select_db('test',$conn);
mysql_query("set names gbk");
$re= mysql_query("select * from test1");
echo "当前表中的记录有：";
echo "<table border=1>"; 
echo "<th colspan='2'>Food</th>";
echo "<tr><td>ID</td><td>姓名</td></tr>";
while($row=mysql_fetch_array($re)) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['name']." </td>";
	echo "</tr>";
  }
  echo "</table>";
?>
</center>
</body>
</html>
