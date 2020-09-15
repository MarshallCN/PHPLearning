<?php
ob_start();
if(is_file('index.shtml')&&(time()-filemtime('./index.shtml')) <30){
	require_once('./index.shtml');
}else{
	require_once("./dropdown.menu.php");
	file_put_contents('./index.shtml',ob_get_contents());
}
?>
