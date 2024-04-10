<? include("inc/header.php");
checkUser(2);
$add_opr=1;
$edit_opr=1;
$delete_opr=0;

$order_opr=1;
$order_fild='ord';

$showID=0;
$title='Itemes';
$table="items";
$order="ord";
$order_dir="ASC";
$rpp=150;//record per page


$condtion="";
$list_arr=array('name','price','act');
$list_names=array('Name','Price','show');
$list_type=array('text','text','act'); 
$list_vld=array('','');
$list_par=array('','');
$list_show=array('1','1','1'); 
include("body.php");
include("inc/footer.php")?>
