<?php
/**Method 1*/
/* class Runtime{
	static $start = 0, $end = 0;
	
	static function microtime_float(){
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	
	static function runStart(){
		self::$start = self::microtime_float();
	}
	
	static function runEnd(){
		self::$end = self::microtime_float();
	}
	
	static function getResult(){
		if((!self::$end) || (!self::$start)){
			return false;
		}
		return self::$end - self::$start;
	}
} */
/* 	
	Runtime::runStart();//开始计时
	sleep(1);
	Runtime::runEnd();//结束计时
	echo Runtime::getResult(); */

/**Method 2*/
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
            //return round(($this->StopTime - $this->StartTime) * 1000, 1);
            return $this->StopTime - $this->StartTime;
        }
    }
	

 	$runtime= new runtime1;
    $runtime->start();

	$sum=0;
	/**Larger loop Inside*/
	// Total check condition = 3*(200000+1) + (3+1) = 600003+4 = 600007 
		for($j=0;$j<=3;$j++){
			for($i=0;$i<=200000;$i++){
				$sum += pow(($i+1),2)*($i+2);
			}
		}
	/**Larger loop Outside*/
	// Total check condition = 200000*(3+1) + (200000+1) = 800000+200001 = 1000001
		/* for($i=0;$i<=200000;$i++){
			for($j=0;$j<=3;$j++){
				$sum += pow(($i+1),2)*($i+2);
			}
		 }*/
	
## Lb = Bigger Loop times; Ls = Small Loop times;
## Larger loop Outside Checks= Lb*(Ls+1)+Lb+1 = Lb*Ls+2Lb+1;
## Smaller loop Outside Checks = Ls*(Lb+1)+Ls+1 = Lb*Ls+2Ls+1;
## if (Lb >= Ls) then (Lb*Ls+2Lb+1) > (Lb*Ls+2Ls+1) => Larger loop Outside > Smaller loop Outside Checks;
## ChecksPercent = (Lb*Ls+2Lb+1) / (Lb*Ls+2Ls+1) = 

		
	
	$runtime->stop();
	echo "<br/>Page Loading: ".$runtime->spent()." s";




	
	
	
?>