<? include("inc/header.php");
$add_opr=2;
$edit_opr=2;
$delete_opr=0;
$showID=1;
$edit_path='editPage.php';
$add_path='addPage.php';

$title=_t_pages;
$table="pages";
$order="id";
$order_dir="ASC";
$rpp=50;//record per page
$condtion="";
$list_arr=array('en_title','ar_title');
$list_names=array(_en_title,_ar_title);
$list_type=array('text','text');
$list_vld=array('','');
$list_par=array('','');
$list_show=array('1','1');



include("body.php");
include("inc/footer.php")?>
