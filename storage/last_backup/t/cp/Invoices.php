<? include("inc/header.php");
checkUser(2);
$add_opr=0;
$edit_opr=0;
$delete_opr=0;
$view_opr=2;
$showID=0;

$title='Invoices';
$table="invices";
$order="date";
$order_dir="DESC";
$rpp=50;//record per page
$edit_path='editCon.php';
$add_path='addPage.php';
$view_link="InviceInfo.php";

$condtion="";
$list_arr=array('c_id','user_id','date');
$list_names=array('Coustomer','User','Date');
$list_type=array('parent','parent','date'); 
$list_vld=array('','');
$list_par=array('customers|company|id','users|fname|id','','');
$list_show=array('1','1','1');
include("body.php");
include("inc/footer.php")?>
