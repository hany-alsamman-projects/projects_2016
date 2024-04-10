<? include("inc/header.php");

$add_opr=1;
$edit_opr=1;
$delete_opr=1;
$showID=0;
$title='Others';
$table="other";
$order="id";
$order_dir="ASC";
$rpp=10;//record per page

$condtion=" where user_id=".$_SESSION['user_id'];
$list_arr=array('user_id','title','t_value','status');
$list_names=array('','Title','Value','Status');
$list_type=array('m_id','text','text','text'); 
$list_vld=array('','');
$list_par=array($_SESSION['user_id'],'','','');
$list_show=array('0','1','1','1');
include("body.php");
include("inc/footer.php")?>
