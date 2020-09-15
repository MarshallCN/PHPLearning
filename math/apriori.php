<?php
class DM{
	function __construct($ary){
		$this->ary = $ary;
		$this->uniAry = $this->uniqueAry();
	}
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
		$freqC = 0;
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
					$freqC++;
				}
			}
			if($isA&&$isB&&$isC){
				$support++;
			}
		}
		if($support!=0){
			$supportPercent = round($support/count($ary),4);
			$confidencePercent = round($support/($freqA),4);
			$lift = round(($support/($freqA))/($freqB/count($ary)),4);
			$res = [
				'S'=>$supportPercent,'C'=>$confidencePercent,'L'=>$lift,
				'S%'=>($supportPercent*100).'%','C%'=>($confidencePercent*100).'%','L%'=>($lift*100).'%',
				'S/'=>$support.'/'.count($ary),'C/'=>$support.'/'.$freqA,'L/'=>$support.'/'.$freqA.'/('.$freqB.'/'.count($ary).')'
			];
			return $res;
		}
	}
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
		$maxsup = 0;
		for($i=0;$i<count($uniAry);$i++){
			$res = $this->getSupportConfidence($uniAry[$i]);
			if($res['S'] >= $minS && !empty($res['S'])){//Cut 1
				if($res['S'] < $maxsup){
					array_push($freqSubset1,[$uniAry[$i] , $res['S'.$u] , $res['C'.$u] , $res['L'.$u]]);
				}else{
					array_unshift($freqSubset1,[$uniAry[$i] , $res['S'.$u] , $res['C'.$u] , $res['L'.$u]]);
					$maxsup = $res['S'];
				}
			}
		}
		$maxsup = 0;
		for($i=0;$i<count($freqSubset1);$i++){
			$A = $freqSubset1[$i][0];
			for($j=$i+1;$j<count($freqSubset1);$j++){
				$B = $freqSubset1[$j][0];
				$res = $this->getSupportConfidence($A,$B);
				if($res['S'] >= $minS && !empty($res['S'])){//Cut 2
					if($res['S'] < $maxsup){
						array_push($freqSubset2,[$A.','.$B , $res['S'.$u] , $res['C'.$u] , $res['L'.$u]]);
					}else{
						array_unshift($freqSubset2,[$A.','.$B , $res['S'.$u] , $res['C'.$u] , $res['L'.$u]]);
						$maxsup = $res['S'];
					}
				}
			}
		}
		$maxsup = 0;
		$fs2Str = '';
		for($i=0;$i<count($freqSubset2);$i++){
			$fs2Str .= $freqSubset2[$i][0].',';
		}
		$fs2Ary = array_unique(explode(',',$fs2Str));
		$fs2UniAry = array();$i=0;
		foreach($fs2Ary as $key=>$value){
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
					$res = $this->getSupportConfidence($A,$B,$C);
					if($res['S'] >= $minS && !empty($res['S'])){//Cut 3
						if($res['S'] < $maxsup){
							array_push($freqSubset3,[$A.','.$B.','.$C , $res['S'.$u] , $res['C'.$u] , $res['L'.$u]]);
						}else{
							array_unshift($freqSubset3,[$A.','.$B.','.$C , $res['S'.$u] , $res['C'.$u] , $res['L'.$u]]);
							$maxsup = $res['S'];
						}
					}
				}
			}
		} 
		$res = 'freqSubset'.$cut;
		return $$res;
	}
}
	//Fried potato shreds, Tomato scrambled egg, Stir-fried cabbage, Laver soup, Boiled meat, Steamed fish, Sauteed celery, Fried chicken steak, Mapo Tofu, Kung Pao Chicken
	/* $dataset_orig = array(
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
		['bread','instant noodles','cola','ice-cream'],
		['ice-cream','instant noodles','napkin'],
		['napkin','ice-cream'],
		['instant noodles','cigarette','cola','yoghourt'],
		['water','instant noodles'],
		['water','instant noodles','cigarette','napkin'],
		['ice-cream','bread','napkin'],
		['instant noodles','cigarette'],
		['ice-cream','instant noodles','cola','napkin'],
		['hotdog','instant noodles','yoghourt'],
	); */
	/* $dataset1 = array(
		['Fried potato shreds','Tomato scrambled egg'],
		['Mapo Tofu','Stir-fried cabbage','Boiled meat','Fried potato shreds'],
		['Fried chicken steak','Steamed fish','Kung Pao Chicken'],
		['Mapo Tofu','Kung Pao Chicken','Stir-fried cabbage'],
		['Laver soup','Boiled meat','Tomato scrambled egg'],
		['Stir-fried cabbage','Mapo Tofu','Boiled meat'],
		['Fried potato shreds','Stir-fried cabbage','Kung Pao Chicken','Mapo Tofu'],
		['Stir-fried cabbage','Laver soup','Kung Pao Chicken','Tomato scrambled egg','Mapo Tofu'],
		['Steamed fish','Sauteed celery','Stir-fried cabbage','Mapo Tofu'],
		['Sauteed celery','Stir-fried cabbage','Tomato scrambled egg'],
		['Fried chicken steak','Kung Pao Chicken','Laver soup','Mapo Tofu'],
		['Mapo Tofu','Kung Pao Chicken','Stir-fried cabbage'],
		['Stir-fried cabbage','Mapo Tofu'],
		['Kung Pao Chicken','Tomato scrambled egg','Laver soup','Sauteed celery'],
		['Fried potato shreds','Kung Pao Chicken'],
		['Fried potato shreds','Kung Pao Chicken','Tomato scrambled egg','Stir-fried cabbage'],
		['Mapo Tofu','Fried chicken steak','Stir-fried cabbage'],
		['Kung Pao Chicken','Tomato scrambled egg'],
		['Mapo Tofu','Kung Pao Chicken','Laver soup','Stir-fried cabbage'],
		['Boiled meat','Kung Pao Chicken','Sauteed celery'],
	); */
	/* alias	items
I1	Kung Pao Chicken
I2	Stir-fried cabbage
I3	Mapo Tofu
I4	Tomato scrambled egg
I5	Fried potato shreds
I6	Boiled meat
I7	Fried chicken steak
I8	Steamed fish
I9	Laver soup
I10	Sauteed celery */
	$dataset = array(
		['I5','I4'],
		['I3','I2','I6','I5'],
		['I7','I8','I1'],
		['I3','I1','I2'],
		['I9','I6','I4'],
		['I2','I3','I6'],
		['I5','I2','I1','I3'],
		['I2','I9','I1','I4','I3'],
		['I8','I10','I2','I3'],
		['I10','I2','I4'],
		['I7','I1','I9','I3'],
		['I3','I1','I2'],
		['I2','I3'],
		['I1','I4','I9','I10'],
		['I5','I1'],
		['I5','I1','I4','I2'],
		['I3','I7','I2'],
		['I1','I4'],
		['I3','I1','I9','I2'],
		['I6','I1','I10'],
	);
	//$dataset = array(['I1','I3','I4'],['I2','I3','I5'],['I1','I2','I3','I5'],['I2','I5']);
	/* $dataset1 = array(
		['broccoli', 'green peppers', 'corn'],
		['asparagus', 'squash', 'corn'],
		['corn', 'tomatoes', 'beans', 'squash'],
		['green peppers', 'corn', 'tomatoes', 'beans'],
		['beans', 'asparagus', 'broccoli'],
		['squash', 'asparagus', 'beans', 'tomatoes'],
		['tomatoes', 'corn'],
		['broccoli', 'tomatoes', 'green peppers'],
		['squash', 'asparagus', 'beans'],
		['beans', 'corn'],
		['green peppers', 'broccoli', 'beans', 'squash'],
		['asparagus', 'beans', 'squash'],
		['squash', 'corn', 'asparagus', 'beans'],
		['corn', 'green peppers', 'tomatoes', 'beans', 'broccoli']
	); */
	$a = new DM($dataset);
	$res = $a->aprior(0.25,2,'%');
	echo "<table border=1><tr><th>itemset</th><th>Support</th><th>Confidence</th><th>Lift</th></tr>";
	for($i=0;$i<count($res);$i++){
		//$color = substr($res[$i][1],0,2)<25?'display:none':'';
		echo "<tr style=''><td>{".$res[$i][0]."}</td>
		<td>".$res[$i][1]."</td>
		<td>".$res[$i][2]."</td>
		<td>".$res[$i][3]."</td></tr>
		";
	}
	echo "</table>";
	/*  echo "<table border=1><tr><th>Itemsets</th><th>Support</th></tr>";
	for($i=0;$i<count($res);$i++){
		$color = substr($res[$i][1],0,2)<25?'display:none':'';
		echo "<tr style='$color'><td>{".$res[$i][0]."}</td>
		<td>".$res[$i][1]."</td></tr>
		";
	}
	echo "</table>";  */
	$res = $dataset;
	/* echo "<table border=1><tr><th>Tid</th><th>items</th></tr>";
	for($i=11;$i<=20;$i++){
		$items = implode(', ',$res[$i-1]);
		echo "<tr><td>".$i."</td>
		<td>".$items."</td></tr>
		";
	}
	echo "</table>"; */

?>