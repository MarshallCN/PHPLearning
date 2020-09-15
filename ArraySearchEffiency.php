<?php
  header("Content-type:text/html;charset=gbk");
    echo '结论：<br>in_array与array_search效率几乎相同，in_array仅返回真伪，array_search同时返回位置.<br>foreach性能最差<br>';
    $runtime= new runtime;
    $runtime->start();

            $a = 'k';
            $b = array('a','b','c','d','e','f','g','h','i','j','k');

    
     /* for ($i=0; $i < 100000; $i++) {
            if(in_array($a, $b)){
				continue;
			};        
    } */
     

    
    /* for ($i=0; $i < 100000; $i++) {
            foreach ($b as $key => $value) {
                    if ($a == $value) {
                            //echo TRUE;
                            continue;
                    }
            }
    } */
    


    
/*     for ($i=0; $i < 100000; $i++) {
            array_search($a, $b);
    } */
    
/* 	for ($i=0; $i < 100000; $i++) {
           for($a=0;$a<count($b);$a++){
				continue;
		   }       
    } */
		/* for ($i=0; $i < 10000; $i++) {
             $str = 'php,java,ruby';
			$arr = split(',',$str);	
				
		} */
		
		 for ($i=0; $i < 10000; $i++) {
            $str = 'php,java,ruby';
			$arr = explode(',',$str);	
					
		} 
		
    $runtime->stop();

    echo "页面执行时间: ".$runtime->spent()." 毫秒";

    class runtime
    {
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
            return round(($this->StopTime - $this->StartTime) * 1000, 1);
        }
    }
    ?>