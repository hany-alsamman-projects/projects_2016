<? include("inc/header.php");
$add_opr=1;
$edit_opr=1;
$delete_opr=1;
$showID=0;
$title='Payments';
$table="payments";
$order="date";
$order_dir="ASC";
$rpp=50;//record per page

$condtion="";
$list_arr=array('date','cus','pay','note');
$list_names=array('Date','Customer','Payment','Note');
$list_type=array('date','parent','text','text','textarea','act'); 
$list_vld=array('NOW()','','','','');
$list_par=array('','customers|company|id','','','');
$list_show=array('1','1','1','1'); 
include("body.php");
include("inc/footer.php")?>
