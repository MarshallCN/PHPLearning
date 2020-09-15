<?php
	require('db.php');
	$sql_getL = "SELECT * FROM (SELECT items,COUNT(items) AS s FROM basket GROUP BY items ORDER BY s DESC) AS temp WHERE s > 1";
	/* $res_L = $mysql->query($sql_getL);
	$L = ['item'=>[],'s'=>[]];
	while($row_L = $mysql->fetch($res_L)){
		array_push($L['item'],$row_L['items']);
		$L['s'][$row_L['items']] = $row_L['s'];
	} */
	$sql_orderedT = "SELECT b.items,b.tid,l.s FROM basket AS b INNER JOIN (SELECT * FROM (SELECT items,COUNT(items) AS s FROM basket GROUP BY items ORDER BY s DESC) AS temp WHERE s > 1) AS l ON b.items = l.items ORDER BY tid, s DESC";
	$FPtree = ['item-name'=>['null'],'s'=>[0],'id'=>[1],'pid'=>[0],'level'=>[0]];
	$res_ordT = $mysql->query($sql_orderedT);
	$id = 1; //auto increment ID
	$tid = 0; //Transaction ID
	$pid = 0; //Parent ID
	$level = 0; //hierarchy level
	while($row_ordT = $mysql->fetch($res_ordT)){
		if($row_ordT['tid'] != $tid){ //New transaction
			if(!in_array($row_ordT['items'],$FPtree['item-name'])){ //New Node from root
				$level = 1;
				$id++;
				array_push($FPtree['item-name'],$row_ordT['items']);
				array_push($FPtree['s'],1);
				array_push($FPtree['pid'],1);
				array_push($FPtree['id'],$id);
				array_push($FPtree['level'],1);
				$pid = $id;
			}else{
				$n = count($FPtree['item-name']);
				for($i=0;$i<$n;$i++){
					if($FPtree['item-name'][$i]==$row_ordT['items']){
						if($FPtree['level'][$i]==1){
							$nodeId = $i;
							$FPtree['s'][$nodeId]++;
							$pid = $nodeId;
							$level = 1;
						}else{
							$level = 1;
							$id++;
							array_push($FPtree['item-name'],$row_ordT['items']);
							array_push($FPtree['s'],1);
							array_push($FPtree['pid'],1);
							array_push($FPtree['id'],$id);
							array_push($FPtree['level'],1);
							$pid = $id;
						}
					}
				}
				
			}
		}else{ // Previous transaction
			if(!in_array($row_ordT['items'],$FPtree['item-name'])){ //New Node
				$id++;
				$level++;
				array_push($FPtree['item-name'],$row_ordT['items']);
				array_push($FPtree['s'],1);
				array_push($FPtree['pid'],$pid);
				array_push($FPtree['id'],$id);
				array_push($FPtree['level'],$level);
				$pid = $id;
			}else{
				$n = count($FPtree['item-name']);
				for($i=0;$i<$n;$i++){
					if($FPtree['item-name'][$i]==$row_ordT['items']){
						if($FPtree['pid'][$i]==$pid){
							$nodeId = $i;
							$FPtree['s'][$nodeId]++;
							$pid = $nodeId;
						}else{
							$id++;
							$level++;
							array_push($FPtree['item-name'],$row_ordT['items']);
							array_push($FPtree['s'],1);
							array_push($FPtree['pid'],$pid);
							array_push($FPtree['id'],$id);
							array_push($FPtree['level'],$level);
							$pid = $id;
						}
					}
				}
				
			}
			
		}
		$tid = $row_ordT['tid'];
		
		
		
	/* 	if(in_array($row_ordT['items'],$FPtree['item-name'])){ //if node exists
			$nodeId = array_search($row_ordT['items'],$FPtree['item-name']);

			if($level==$FPtree['level'][$nodeId]){
				$FPtree['s'][$nodeId]++;
				$pid = $FPtree['id'][$nodeId];
			}else{
				array_push($FPtree['item-name'],$row_ordT['items']);
				array_push($FPtree['s'],1);
				array_push($FPtree['pid'],$pid);
				array_push($FPtree['level'],$level);
				$id++;
				$pid = $id;
				array_push($FPtree['id'],$id); //add id in tree node
			}
		}else{//new node
			array_push($FPtree['item-name'],$row_ordT['items']);
			array_push($FPtree['s'],1);
			array_push($FPtree['pid'],$pid);
			$level++;
			array_push($FPtree['level'],$level);
			$id++;
			$pid = $id;
			array_push($FPtree['id'],$id); //add id in tree node
		}
		$tid = $row_ordT['tid'];*/
	} 
	print_r($FPtree);
?>