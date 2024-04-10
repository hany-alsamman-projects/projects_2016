<? include("inc/header2.php");

$add_opr=1;
$edit_opr=1;
$delete_opr=1;
$showID=1;
$title='Users';
$table="users";
$order="id";
$order_dir="ASC";
$rpp=10;//record per page

$condtion="";
$list_arr=array('un','pw','short','act'); 
$list_names=array('User Name','Password','Short Link','Ative');
$list_type=array('text','pass','text','act'); 
$list_vld=array('','');
$list_par=array('','','');
$list_show=array('1','0','1','1');

include("body.php");
include("inc/footer.php")?>
