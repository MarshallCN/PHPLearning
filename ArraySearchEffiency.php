<?php
  header("Content-type:text/html;charset=gbk");
    echo '���ۣ�<br>in_array��array_searchЧ�ʼ�����ͬ��in_array��������α��array_searchͬʱ����λ��.<br>foreach�������<br>';
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

    echo "ҳ��ִ��ʱ��: ".$runtime->spent()." ����";

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