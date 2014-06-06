<?php
$arr = explode('.',$_SERVER['HTTP_HOST']);
$arrc = count($arr);
$res = array();
for($i=0;$i<$arrc;$i++) {
	if(strlen($arr[$i])<4)
		 $res[] = $arr[$i];
}
$this_tld = implode('.',array_reverse($res)); //reverse the array and reconstruct into a string	
$this_tld = trim($this_tld,'.'); //strip the trailing full stop
$this_tld = str_replace("www","",$this_tld); //hack
$this_tld = str_replace(".","",$this_tld); //hack again
?>