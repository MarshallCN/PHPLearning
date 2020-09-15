<html>
<head>
<title>浏览表中记录</title>
</head>
<body>
<center>
<?php
$db_host='localhost'; 
$db_user='root'; 
$db_pass="0618"; 
$db_name="test"; 
$link=mysql_connect($db_host,$db_user,$db_pass)or die("不能连接到服务器".mysql_error());
mysql_select_db($db_name,$link); 
//mysql_query("set names gbk");
$sql="select * from test1"; 
$result=mysql_query($sql,$link); 
echo "当前表中的记录有：";
echo "<table border=1>"; 
echo "<tr><td>ID</td><td>姓名</td></tr>";
while($row=mysql_fetch_array($result)) {
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
</center>
</body>
</html>
