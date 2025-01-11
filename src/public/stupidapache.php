<?php
$pathinfo=$_SERVER['REQUEST_URI'];
if (strpos($pathinfo,"?")!==false){
	//in case anyone puts a query at the end, it'll still work
	$query=substr($pathinfo,strrpos($pathinfo,"?")+1);
	parse_str($query,$_GET);
	$pathinfo=substr($pathinfo,0,strpos($pathinfo,"?"));
}
if (strpos($pathinfo,".")!==false){
	//in case anyone puts an extention at the end, it'll still work
	$extention=substr($pathinfo,strrpos($pathinfo,"."));
	$pathinfo=substr($pathinfo,0,strpos($pathinfo,"."));
}
$fullpath=$pathinfo;
if($pathinfo=="/")$pathinfo="/index";
while($pathinfo){
	$pathinfo=substr($pathinfo,1);
	if (strpos($pathinfo,"/")!==false){
		$file=substr($pathinfo,0,strpos($pathinfo,"/"));
		$pathinfo=substr($pathinfo,strpos($pathinfo,"/"));
	}
	else{
		$file=$pathinfo;
		unset($pathinfo);
	}
	if(is_dir($file))chdir($file);
	else $toplevel=true;
	$error.=$file."; ".$pathinfo."<br />";
	if(file_exists($file.".php")){
		if(!$pathinfo)$pathinfo="/";
		$_SERVER['ORIG_PATH_INFO']=$pathinfo.$extention;
		header("HTTP/1.1 200 OK");
		include($file.".php");
		exit;
	}
	if($toplevel)break;
}

?>
