<pre>
<?php
require "db.php";
class runtime1{
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
class Math{
	function __construct($ary){
		$this->ary = $ary;
		$this->uniAry = $this->uniqueAry();
	}
/*Create random text*/
	function randomText($length=6){
		$length=(int)$length;
		if($length>32||$length<3){
			$length==6;
		}
		return base64_encode(mcrypt_create_iv($length,MCRYPT_DEV_RANDOM));
	}
/*Get all unique elements in 2D array*/
	function uniqueAry($dataSetAry=''){
		$ary = empty($dataSetAry)?$this->ary:$dataSetAry;
		$uniqueAry = [];
		for($i=0;$i<count($ary);$i++){
			for($j=0;$j<count($ary[$i]);$j++){
				if(isset($ary[$i][$j])){
					if(!in_array($ary[$i][$j],$uniqueAry,true)){
						array_push($uniqueAry,$ary[$i][$j]);
					}
				}
			}
		}
		return $uniqueAry;
	}
	function uniAryS($dataSetAry=''){
		$ary = empty($dataSetAry)?$this->ary:$dataSetAry;
		//$uniqueAry = ['items'=>[],'support'=>[]];
		$uniqueAry2=[];
		for($i=0;$i<count($ary);$i++){
			for($j=0;$j<count($ary[$i]);$j++){
				if(isset($ary[$i][$j])){
					//if(!in_array($ary[$i][$j],$uniqueAry['items'],true)){
					//	array_push($uniqueAry['items'],$ary[$i][$j]);
					//	$uniqueAry['support'][$ary[$i][$j]] = 1;
					//}else{
					//	$uniqueAry['support'][$ary[$i][$j]]++;
					//}
					array_push($uniqueAry2,$ary[$i][$j]);
				}
			}
		}
		//array_multisort($uniqueAry['support'],SORT_DESC,$uniqueAry['items']);
		//return $uniqueAry;
		$uniqueAry2 = array_count_values($uniqueAry2);
		arsort($uniqueAry2);
		return $uniqueAry2;
	}
/*Use linear regression to estimate the y of the x*/
	function linearRegression($x=0){ //化简后的一元回归方程表示
		$aSum = 0;
		$bSum = 0;
		$a2Sum = 0;
		$abProSum = 0;
		for($i=0;$i<count($this->ary);$i++){
			$abProSum += $this->ary[$i][0] * $this->ary[$i][1]; //a,b积的求和
			$aSum += $this->ary[$i][0]; //a累加
			$bSum += $this->ary[$i][1]; //b累加
			$a2Sum += pow($this->ary[$i][0],2); //a平方的求和
		}
		$denominator = count($this->ary)*$a2Sum - pow($aSum,2); //分母：a个数 * a平方求和 - a累加的平方 
		$k = (count($this->ary)*$abProSum - $aSum*$bSum)/$denominator; //回归系数：（数据个数 * ab积求和 - ab累加的积）/分母
		$c = ($a2Sum*$bSum - $aSum*$abProSum)/$denominator; //回归常数： （a平方的求和*b求和 - a求和*ab积求和）/分母
		$y = $k*$x+$c;
		echo "f(x)=".$k."x+".$c.'<br/>';
		echo "x = $x <br/> y = $y";
	}
	function linearRegression1($x=0){ //原版一元回归方程,2次遍历
		$n = count($this->ary);
		$aSum = 0;
		$bSum = 0;
		for($i=0;$i<$n;$i++){
			$aSum += $this->ary[$i][0];
			$bSum += $this->ary[$i][1];
		}
		$aAvg = $aSum/$n;
		$bAvg = $bSum/$n;
		$numerator = 0;
		$denominator = 0;
		for($i=0;$i<$n;$i++){
			$numerator += ($this->ary[$i][0]-$aAvg)*($this->ary[$i][1]-$bAvg);
			$denominator += pow($this->ary[$i][0]-$aAvg,2);
		}
		$k = $numerator/$denominator;
		$c = $bAvg-($aAvg*$k);
		$y = $k*$x+$c;
		echo "f(x)=".$k."x+".$c.'<br/>';
		echo "x = $x <br/> y = $y";
	}
/*Get support and confidence of A->B(s,c)*/
	function getSupportConfidence($A,$B='',$C='',$dataSetAry=''){
		$ary = empty($dataSetAry)?$this->ary:$dataSetAry;
		if($B==''){
			$B=$A;
		}
		if($C==''){
			$C=$A;
		}
		$support = 0;
		$freqA = 0;
		$freqB = 0;
		for($i=0;$i<count($ary);$i++){
			$isA = false;
			$isB = false;
			$isC = false;
			for($j=0;$j<count($ary[$i]);$j++){
				if($ary[$i][$j]==$A){
					$isA = true;
					$freqA++;
				}
				if($ary[$i][$j]==$B){
					$isB = true;
					$freqB++;
				}
				if($ary[$i][$j]==$C){
					$isC = true;
				}
			}
			if($isA&&$isB&&$isC){
				$support++;
			}
		}
		$supportPercent = round($support/count($ary),4);//Support(A->B) = P(A n B) = P(A,B)/P(I) = num(A n B)/num(I)
		$confidencePercent = round($support/$freqA,4);//Confidence(A->B) = P(B|A) = P(A,B)/P(A) = num(A n B)/num(A); freqB/freqA,freq(B&C)/freqA,freq(B&...&N)/freqA
		$lift =  round(($support/$freqA)/($freqB/count($ary)),4);//Lift(A->B) = P(B|A)/P(B) = Confidence(A->B)/(num(B)/num(I)); Only for A->B (Not consider C)
		$res = [
			'S'=>$supportPercent,'C'=>$confidencePercent,'L'=>$lift,
			'S%'=>($supportPercent*100).'%','C%'=>($confidencePercent*100).'%','L%'=>($lift*100).'%',
			'S/'=>$support.'/'.count($ary),'C/'=>$support.'/'.$freqA,'L/'=>$support.'/'.$freqA.'/('.$freqB.'/'.count($ary).')'
		];
		return $res;
	}
/*Get support and confidence of A->B(s,c)*/
	function find2SC($minS=0,$minC=0,$u='%',$dataSetAry=''){
		if($minS>1||$minC>1){
			echo 'Error: Support_min or Confidence_min cannot greater than 1';
			return false;
		}
		$ary = empty($dataSetAry)?$this->ary:$dataSetAry;
		$uniAry = $this->uniqueAry();
		for($i=0;$i<count($uniAry);$i++){
			$A = $uniAry[$i];
			for($j=$i+1;$j<count($uniAry);$j++){
				$B = $uniAry[$j];
				$A_B = $this->getSupportConfidence($A,$B);
				$B_A = $this->getSupportConfidence($B,$A);
				if($A_B['S']>=$minS&&$A_B['C']>=$minC){
					echo $A.'->'.$B.': S/'.$A_B['S'.$u].',&nbsp;C/'.$A_B['C'.$u].'&nbsp;L/'.$A_B['L'.$u].'&nbsp;';
				}
				if($B_A['S']>=$minS&&$B_A['C']>=$minC){
					echo $B.'->'.$A.': S/'.$B_A['S'.$u].',&nbsp;C/'.$B_A['C'.$u].'&nbsp;L/'.$B_A['L'.$u].'<br/>';
				}
			}
		}
	}
/*依次组合删除支持度最低的（低于最低支持度）;$cut means cut times [1,3]*/	
	function aprior($minS=0,$cut=1,$u='%'){
		if($minS>1){
			echo 'Error: Support_min cannot greater than 1';
			return false;
		}
		if($cut>3||$cut<1){
			echo 'Error: Cut times must be set in [1,3]';
			return false;
		}
		$uniAry = $this->uniAry;
		$freqSubset1 = array();
		$freqSubset2 = array();
		$freqSubset3 = array();
		for($i=0;$i<count($uniAry);$i++){
			if($this->getSupportConfidence($uniAry[$i])['S'] >= $minS){//Cut 1
				array_push($freqSubset1,[$uniAry[$i] , $this->getSupportConfidence($uniAry[$i])['S'.$u]]);
			}
		}
		for($i=0;$i<count($freqSubset1);$i++){
			$A = $freqSubset1[$i][0];
			for($j=$i+1;$j<count($freqSubset1);$j++){
				$B = $freqSubset1[$j][0];
				if($this->getSupportConfidence($A,$B)['S'] >= $minS){//Cut 2
					array_push($freqSubset2,[$A.','.$B , $this->getSupportConfidence($A,$B)['S'.$u]]);
				}
			}
		}
		$fs2Str = '';//Create frequent subset 2 string
		for($i=0;$i<count($freqSubset2);$i++){
			$fs2Str .= $freqSubset2[$i][0].',';
		}
		$fs2Ary = array_unique(explode(',',$fs2Str));//Create frequent subset 2 unique array
		$fs2UniAry = array();$i=0;
		foreach($fs2Ary as $key=>$value){//Align index and delete empty value
			if($value!=''){
				$fs2UniAry[$i]=$value;
				$i++;
			}
		}
		for($i=0;$i<count($fs2UniAry);$i++){
			$A = $fs2UniAry[$i];
			for($j=$i+1;$j<count($fs2UniAry);$j++){
				$B = $fs2UniAry[$j];
				for($v=$j+1;$v<count($fs2UniAry);$v++){
					$C = $fs2UniAry[$v];
					if($this->getSupportConfidence($A,$B,$C)['S'] >= $minS){//Cut 3
						array_push($freqSubset3,[$A.','.$B.','.$C , $this->getSupportConfidence($A,$B,$C)['S'.$u]]);
					}
				}
			}
		} 
		$res = 'freqSubset'.$cut;
		return $$res;
	}
/* k-Nearest Neighbor (kNN) */
	function knn($k,$new=[]){
		$distance = [];
		for($i=0;$i<count($this->ary);$i++){
			$sums = 0;
			for($j=0;$j<count($new);$j++){
				$sums += pow($this->ary[$i][$j]-$new[$j],2);
			}
			$d = sqrt($sums);
			array_push($distance,['distance'=>$d,'id'=>$i]);
		}
		sort($distance);
		$class = [];
		for($v=0;$v<$k;$v++){
			array_push($class,$this->ary[$distance[$v]['id']][count($new)]);
		}
		$vote = array_count_values($class);
		arsort($vote);
		print_r($vote);
	}
}

//$dataset = array([1,2],[3,3],[23,46],[33,69],[3,5],[45,92],[23,45]);
$dataset = array([165,50],[170,60],[175,62],[166,58],[164,50],[155,45],[180,75],[172,70],[160,48],[164,49]);
$dataset_char1 = array(['A','C','D'],['B','C','E'],['A','B','C','E'],['B','E']);
$dataset_char2 = array(['orange juice','soda'],['milk','orange juice','window cleaner'],['orange juice','detergent','soda'],['window cleaner','soda'],['soda','potato chips']);
$dataset_char3 = [['Cola','Egg','Ham'],['Cola','Diaper','Beer'],['Cola','Diaper','Beer','Ham'],['Diaper','Beer']];
$dataset_num1 = array([1,3,4],[2,3,5],[1,2,3,5],[2,5]);
$dataset_num2 = array([1,2,5],[2,4],[2,3],[1,2,4],[1,3],[2,3],[1,3],[1,2,3,5],[1,2,3]);
$test_ques = [['A','B','C'],['A','B','E'],['A','C','D'],['A','B','D']];
	//$runtime= new runtime1;
    //$runtime->start();
//for($t=0;$t<1000;$t++){
$a = new Math($dataset);
//$a->linearRegression();
//}
	//$runtime->stop();
	//echo "<br/>Page Loading: ".$runtime->spent()." s";

$dataset_char = array(
	['Beer','Nuts','Diaper'],
	['Beer','Coffee','Diaper'],
	['Beer','Diaper','Eggs'],
	['Nuts','Eggs','Milk'],
	['Nuts','Coffee','Diaper','Eggs','Milk']
);
$b = new Math($dataset_char);
//$b->find2SC(0.4,0,'/');
//print_r($b->aprior(0.4,2));

/* FP-Growth测试Beer Diaper */
//项头表，依据支持度排序
$head_tbl = array(['Beer',3],['Nuts',3],['Diaper',4],['Coffee',2],['Eggs',3],['Milk',2]);
$head_tbl = array(['Diaper',4],['Beer',3],['Nuts',3],['Eggs',3],['Coffee',2],['Milk',2]);
//删掉支持度<2的,(此例无)
$head_tbl = array(['Diaper',4],['Beer',3],['Nuts',3],['Eggs',3],['Coffee',2],['Milk',2]);
//清理and排序原数据集
$dnew = array(
	['Diaper','Beer','Nuts'],
	['Diaper','Beer','Coffee'],
	['Diaper','Beer','Eggs'],
	['Nuts','Eggs','Milk'],
	['Diaper','Nuts','Eggs','Coffee','Milk']
);
//构建FP-Tree
//$mysql->query("INSERT fptree VALUE('','Root',' ','0')");
/* for($i=0;$i<count($dnew);$i++){
	$path = 'Root';
	for($v=0;$v<count($dnew[$i]);$v++){
		$node = $dnew[$i][$v];
		$sql_search = "SELECT * FROM fptree WHERE path = '$path' AND node = '$node'";
		//$res_search = $mysql->query($sql_search);
		if(mysql_num_rows($res_search)>0){
		//更新已有节点
			$nodeinfo = $mysql->fetch($res_search);
			$nodeid = $nodeinfo['id'];
			$sql_update = "UPDATE fptree SET num = num+1 WHERE id = $nodeid";
			//$mysql->query($sql_update);
		}else{
		//从Null开始的新节点
			$sql_add = "INSERT fptree(node,path,num) VALUES('$node','$path','1')";
			//$mysql->query($sql_add);
		}
		$path .= "/$node";
	}
} */
//FP-Tree挖掘，从项头表末尾开始，寻找路径，which所有节点初始等于末尾点，再累加计数，删除低于阈值的节点
for($n=1;$n<count($head_tbl);$n++){ //Ignore the first node which has no conditional pattern base 
	$mineNode = $head_tbl[$n][0];
//分割字符串，用mysql还是php?
	$sql_conTree = "SELECT * FROM fptree WHERE node = '$mineNode'";
	$res_conTree = $mysql->query($sql_conTree);
	$subTree[$mineNode] = [];//Only shows the sub-tree, hard to manipulate
	while($row = $mysql->fetch($res_conTree)){
		$initNum = $row['num'];
		$sub_path = explode("/",$row['path']);
		for($i=1;$i<count($sub_path);$i++){ //start from 1, ignore root node
			$sql_find = "SELECT COUNT(*) FORM subtree WHERE node = '$mineNode' AND assoc = '".$sub_path[$i]."'";
			//if($mysql->oneQuery($sql_find) > 0){
			if(array_key_exists($sub_path[$i],$subTree[$mineNode])){
			//Update existing node	
				$subTree[$mineNode][$sub_path[$i]]++;
				//$mysql->query("UPDATE subtree SET num = num+1 WHERE node = '$mineNode' AND assoc = '".$sub_path[$i]."'");
			}else{
			//New node	
				$subTree[$mineNode][$sub_path[$i]] = $initNum;
				//$mysql->query("INSERT subtree(node,assoc,num) VALUES ('$mineNode','".$sub_path[$i]."','$initNum')");
			}
		}
	}
}
	print_r($subTree);


$c = new Math($dataset_num1);
//$c->find2SC(0.5,1,'%');
//print_r($c->aprior(0.5,3));
//print_r($c->getSupportConfidence('Beer','Diaper','',$dataset_char));
$d = new Math($dataset_num2);
//$d->find2SC(0.2,0.2,'%');
//print_r($d->aprior(0.2,3,'%'));
$e = new Math($dataset_char2);
//$e->find2SC(0.3,0.3,'%');
//print_r($e->aprior(0.2,2,'%'));
$test = new Math($test_ques);
//$test->find2SC(0.1,0.1);

$f = new Math($dataset_char3);
//print_r($f->aprior(0.5,2,'%'));
/* $L = $f->uniAryS();
foreach($L as $key => $value){
	if($value < 2){
		unset($L[$key]);
	}
}
print_r($L);
$FPtree = array();
for($i=0;$i<count($dataset_char3);$i++){
	for($j=0;$j<count($dataset_char3[$i]);$j++){
		$dataset_char3[$i][$j];
	}
} */
/* $dataset_gtd = array();
$sql_gtd = "SELECT * FROM gtd limit 10";
$res_gtd = $mysql->query($sql_gtd);
while($row = $mysql->fetch($res_gtd)){
	array_push($dataset_gtd,['region:'.$row[1],'multiple'.$row[2],'success:'.$row[3],'suicide:'.$row[4],'extended:'.$row[5],'attacktype:'.$row[6],'targtype:'.$row[7],'weaptype:'.$row[8],]);
} */
//$gtd = new Math($dataset_gtd);
//$gtd->find2SC(0.3,0.8);
//print_r($gtd->aprior(0.5,2));
//['water','cola','bread','milk','yoghourt','napkin','ice-cream','hotdog','instant noodles','cigarette']
$dataset_canteen = array(
	['water','cigarette'],
	['ice-cream','napkin','hotdog','water'],
	['bread','milk','instant noodles'],
	['ice-cream','instant noodles','napkin'],
	['cola','hotdog','cigarette'],
	['napkin','ice-cream','hotdog'],
	['water','napkin','instant noodles','ice-cream'],
	['napkin','cola','instant noodles','cigarette','ice-cream'],
	['milk','yoghourt','napkin','ice-cream'],
	['yoghourt','napkin','cigarette'],
	['bread','instant noodles','cola'],
	['ice-cream','instant noodles','napkin'],
	['napkin','ice-cream'],
	['instant noodles','cigarette','cola','yoghourt'],
	['water','instant noodles'],
	['water','instant noodles','cigarette','napkin'],
	['ice-cream','bread','napkin'],
	['instant noodles','cigarette'],
	['ice-cream','instant noodles','cola','napkin'],
	['hotdog','instant noodles','yoghourt'],
);
$ct = new Math($dataset_canteen);
//$ct->find2SC(0.3,0.8);
//print_r($ct->aprior(0.4,2));
$dataset_knn = [[25,40000,'n'],[35,60000,'n'],[45,80000,'n'],[20,20000,'n'],[35,120000,'n'],[52,18000,'n'],[23,96000,'y'],[40,62000,'y'],[60,100000,'y'],[48,220000,'y'],[33,150000,'y']];
$knn = new Math($dataset_knn);
//$knn->knn(3,[48,142000]);
?>
</pre>