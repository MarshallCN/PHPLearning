<?php
    class Calc {
		public function __construct($s1_new,$s2_new,$e1_new,$e2_new,$s2_walk,$bd,$s1,$s2,$e1,$e2) {
		    $this->s1_new = $s1_new;
		    $this->s2_new = $s2_new;
		    $this->e1_new = $e1_new;
		    $this->e2_new = $e2_new;
	    	$this->s2_walk = $s2_walk;
	    	$this->bd = $bd;
	    	$this->s1 = $s1;
	        $this->s2 = $s2;
	    	$this->e1 = $e1;
	    	$this->e2 = $e2;
		}
		public function calculate() {
			$star ="<span id='red'>  * </span>";
			$o = "<span id='Green'>  o </span>";
	        for ($loop_time=0;$loop_time<abs($this->s2-$this->e2)+1;$loop_time++) {
		        if($this->e2_new > $this->s2_walk) {
                    $this->s2_walk++;
				}else if($this->e2_new < $this->s2_walk) {
					$this->s2_walk--;
				}else{
				}
			    if($this->bd[$this->s1_new][$this->s2_walk]=="  + ") {
		            $this->bd[$this->s1_new][$this->s2_walk]= $o;	
				}else if ($this->bd[$this->s1_new][$this->s2_walk]==$star) {
					$loop_time--;
					if ($this->e1_new > $this->s1_new) {
						$this->s1_new++;
					}else if ($this->e1_new < $this->s1_new){
						$this->s1_new--;
					}else {
						if($this->bd[$this->s1_new+1][$this->s2_walk]==$star) {
							$this->s1_new--;
						}else if($this->bd[$this->s1_new-1][$this->s2_walk]==$star){
							$this->s1_new++;
						}else{$this->s1_new--;}
					}
					if($this->e2_new > $this->s2_new) {
						$this->s2_walk--;
					}else if ($this->e2_new < $this->s2_new) {
						$this->s2_walk++;
					}else {echo '567';}
					$this->bd[$this->s1_new][$this->s2_walk]= $o;
				}
			}
			for ($loop_time=0;$loop_time<abs($this->e1-$this->s1)+1;$loop_time++) {
				if($this->e1_new > $this->s1_new) {
					$this->s1_new++;
				}else if($this->e1_new < $this->s1_new){
					$this->s1_new--;
				}else{
					break;
				}
				if($this->bd[$this->s1_new][$this->s2_walk]=="  + ") {
		            $this->bd[$this->s1_new][$this->s2_walk]= $o;	
				}else if ($this->bd[$this->s1_new][$this->s2_walk]==$star) {
					$loop_time--;
					if ($this->e2_new > $this->s2) {
						$this->s2_walk++;
					}else if($this->e2_new < $this->s2){
						$this->s2_walk--;
					}else{
						if($this->bd[$this->s1_new][$this->s2_walk-1]==$star) {
							$this->s2_walk++;
						}else if($this->bd[$this->s1_new][$this->s2_walk+1]==$star){
							$this->s2_walk--;
						}else{$this->s2_walk++;}
					}
					if ($this->e1_new > $this->s1_new) {
						$this->s1_new--;
					}else{
						$this->s1_new++;
					}$this->bd[$this->s1_new][$this->s2_walk]= $o;	
				}
			}   
		}
		public function printb() {
			for($i=0;$i < count($this->bd);$i++) {
	            for($n=0;$n< count($this->bd[$i]);$n++){
                    echo $this->bd[$i][$n];
                    $len = count($this->bd)+1;
                    if($n == $len) {
                        echo "<br/>";
                    }
	            }
			}
        }
		public function countr() {
		    $dis =1;
		    foreach ($this->bd as $item_row) {                                                          
		        foreach ($item_row as $item_col) {
					if ($item_col =="<span id='Green'>  o </span>") {
						$dis++;
				    }
				}
			}return $dis;
        }
	}
?>