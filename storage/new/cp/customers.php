<? include("inc/header.php");
checkUser(2);
$add_opr=1;
$edit_opr=1;
$delete_opr=0;
$showID=0;
$title='Customers';
$table="customers";
$order="company";
$order_dir="ASC";
$rpp=50;//record per page

$condtion="";
$list_arr=array('company','name','phone','mobile','note','act');
$list_names=array('Company','Contant','Phone','Mobile','Note','Show');
$list_type=array('text','text','text','text','textarea','act'); 
$list_vld=array('','','','','');
$list_par=array('','','','','');
$list_show=array('1','1','1','1','1','1'); 
include("body.php");
include("inc/footer.php")?>
