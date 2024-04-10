<? include("inc/header.php");
checkUser(2);
$add_opr=0;
$edit_opr=0;
$delete_opr=0;
$view_opr=2;
$showID=0;

$title='Containers';
$table="orders";
$order="id";
$order_dir="DESC";
$rpp=50;//record per page
$edit_path='editCon.php';
$add_path='addPage.php';
$view_link="ContainerInfo.php";

$condtion="";
$list_arr=array('name','num','expenses','user_id','date','fin');
$list_names=array('LOT#','Container number','Expenses','User','Date','Finash');
$list_type=array('text','text','text','parent','date','act',); 
$list_vld=array('','');
$list_par=array('','','','users|fname|user_id','','');
$list_show=array('1','1','1','1','1','1');
include("body.php");
include("inc/footer.php")?>
