<?php
 class Mysql{
	function __construct(){
		$this->conn=$this->getConn();
	}
	function getConn(){
        $conn =  mysql_connect('localhost','root','') or die("Cannot connect to server".mysql_error());
        $db = mysql_select_db("test",$conn);
        mysql_query("set names gbk");
        return $conn;
    }
	function fetch($result){
        $row = mysql_fetch_array($result);
        return $row;
    }
	function query($sql){
        $res = mysql_query($sql,$this->conn) or die(mysql_error());
		return $res;
	}
	function oneQuery($sql){	//Get one value from db
		return $this->fetch($this->query($sql))[0];
	}
}
$mysql = new Mysql();
?>