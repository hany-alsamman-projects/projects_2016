<? 
session_start();
include_once("../min/dbc.php");

if(isset($_REQUEST['lg'])){
	$lg=$_REQUEST['lg'];
	$_SESSION['lg']=$_REQUEST['lg'];
}else if(isset($_SESSION['lg'])){
	$lg=$_SESSION['lg'];
}else{
	$lg='en';
}
include_once("inc/".$lg."_define.php");

$langs=array('en','ar');
$lang_name=array(_en,_ar);

$LANG_URL='';
$LANG_URL.='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$u=explode('?',$_SERVER['REQUEST_URI']);
if(count($u)>1){
	if(isset($_REQUEST['lg'])){
		$LANG_URL=substr($LANG_URL,0,strlen($LANG_URL)-6);
	}
	$u2=explode('?',$LANG_URL);
	if(count($u2)>1){
		$LANG_URL.="&lg="._xlg;
	}else{
		$LANG_URL.="?lg="._xlg;
	}
}else{
	$LANG_URL.="?lg="._xlg;
}
include_once("inc/funs.php");
?>