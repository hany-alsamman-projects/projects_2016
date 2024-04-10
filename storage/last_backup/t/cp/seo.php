<? include("inc/header.php");

$add_opr=1;
$edit_opr=1;
$delete_opr=0;
$showID=0;
$title='SEO';
$table="seo";
$order="id";
$order_dir="ASC";
$rpp=10;//record per page

$condtion=" where id=".$_SESSION['user_id'];
$list_arr=array('user_id','title','des','keywords','facebook_des','facebook_image');
$list_names=array('','Title','Description ','Keywords','Facebook Des','Facebook Image');
$list_type=array('m_id','text','textarea','textarea','textarea','photo'); 
$list_vld=array('','');
$list_par=array($_SESSION['user_id'],'','1:User|2:Admin','');
$list_show=array('0','1','0','0','0','1');

include("body.php");
include("inc/footer.php")?>
