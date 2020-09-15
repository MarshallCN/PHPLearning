<html> 

<head> 

<meta http-equiv="Content-Type" content="text/html; charset=gb2312"> 

<title></title> 

<script> 

function $(v){return document.getElementById(v);} 

function aa(){ 

var x=document.getElementById("a").value; 

document.getElementById("a").value = parseInt(x)+1;

} 


</script> 

</head> 

<body><input type='number' name="a"/><button type=button onclick='aa()' >+</button><div id="a">1</div><button type="button" style="width:80px;height:22px;" onclick="aa()">点击+1...</button> 

</body> 

</html>