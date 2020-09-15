<pre>
<?php
require('db.php');
class runtime{
        var $StartTime = 0;
        var $StopTime = 0;
        function get_microtime()
        {
            list($usec, $sec) = explode(' ', microtime());
            return ((float)$usec + (float)$sec);
        }

        function start()
        {
            $this->StartTime = $this->get_microtime();
        }

        function stop()
        {
            $this->StopTime = $this->get_microtime();
        }

        function spent()
        {
            return round(($this->StopTime - $this->StartTime), 10);
            //return $this->StopTime - $this->StartTime;
        }
}
$runtime= new runtime;
$runtime->start();
/* FP-Growth */

//Scan data source, create header table

$sql_scan1 = "SELECT * FROM datasrc";
$res_scan = $mysql->query($sql_scan1);
while($row = $mysql->fetch($res_scan)){
	$items = explode(",",$row['items']);
	for($i=0;$i<count($items);$i++){
		//if the item exists in header table, update num
		$node = $items[$i];
		$res_headers = $mysql->query("SELECT * FROM header WHERE node = '$node'");
		if(mysql_num_rows($res_headers) > 0){
			$headers = $mysql->fetch($res_headers);
			$hitem_id = $headers['id'];
			$mysql->query("UPDATE header SET num = num +1 WHERE id = '$hitem_id'");
		//else, add new item
		}else{
			$mysql->query("INSERT header(node,num) VALUE('$node','1')");
		}
	}
}

 
//项头表，依据支持度排序,并删掉支持度<2的,(此例无)

$sql_headers = "SELECT * FROM header ORDER BY num DESC";
$res_headers = $mysql->query($sql_headers);
$headers = [];
while($row = $mysql->fetch($res_headers)){
	$headers[$row['node']] = $row['num'];
}
//print_r($headers);
 

//Order item according to headers table
function compareAB($a,$b){
	global $headers;
	if($headers[$a]>=$headers[$b]){
		return -1;
	}else{
		return 1;
	}
}

//Send Scan
//Build FP-Tree

$sql_scan2 = "SELECT * FROM datasrc";
$res_scan = $mysql->query($sql_scan2);
$mysql->query("INSERT fptree VALUE('','Root',' ','0')");
while($row = $mysql->fetch($res_scan)){
	//根据Header 来为datasrc排序
	$items = explode(",",$row['items']);
	usort($items,"compareAB");
	$path = 'Root';	
	for($v=0;$v<count($items);$v++){
		$node = $items[$v];
		//MIN SUPPORT is 3
		if($headers[$node]>=3){
		$sql_search = "SELECT * FROM fptree WHERE path = '$path' AND node = '$node'";
		$res_search = $mysql->query($sql_search);
		if(mysql_num_rows($res_search)>0){
		//更新已有节点
			$nodeinfo = $mysql->fetch($res_search);
			$nodeid = $nodeinfo['id'];
			$sql_update = "UPDATE fptree SET num = num+1 WHERE id = $nodeid";
			$mysql->query($sql_update);
		}else{
		//从Null开始的新节点
			$sql_add = "INSERT fptree(node,path,num) VALUES('$node','$path','1')";
			$mysql->query($sql_add);
		}
		$path .= "/$node";
		} 
	}
}


//FP-Tree挖掘，从项头表末尾开始，寻找路径，which所有节点初始等于末尾点，再累加计数，删除低于阈值的节点
$sql_headers_trim = "SELECT * FROM header WHERE num>=3 ORDER BY num ASC";
$res_headers_trim = $mysql->query($sql_headers_trim);
while($row_fp = $mysql->fetch($res_headers_trim)){
	$mineNode = $row_fp['node'];
	//To Find CBP(conditional base pattern)
	$sql_conTree = "SELECT * FROM fptree WHERE node = '$mineNode'";
	$res_conTree = $mysql->query($sql_conTree);
	$subTree[$mineNode] = [];//Only shows the sub-tree, hard to manipulate
	while($row = $mysql->fetch($res_conTree)){
		$initNum = $row['num'];
		$sub_path = explode("/",$row['path']);
		for($i=0;$i<count($sub_path);$i++){ //$i=0 mens the node->root, which is its own support value
			$sql_find = "SELECT COUNT(*) FROM subtree WHERE node = '$mineNode' AND assoc = '".$sub_path[$i]."'";
			if($mysql->oneQuery($sql_find) > 0){
			//if(array_key_exists($sub_path[$i],$subTree[$mineNode])){ //$subTree is only used for testing
			//Update existing node	
				$subTree[$mineNode][$sub_path[$i]] += $initNum;
				$mysql->query("UPDATE subtree SET num = num+$initNum WHERE node = '$mineNode' AND assoc = '".$sub_path[$i]."'");
			}else{
			//New node	
				$subTree[$mineNode][$sub_path[$i]] = $initNum;
				$mysql->query("INSERT subtree(node,assoc,num) VALUES ('$mineNode','".$sub_path[$i]."','$initNum')");
			}
		}
	}
}
//print_r($subTree);
$runtime->stop();
echo "<br/>Page Loading: ".$runtime->spent()." s";
?>
</pre>