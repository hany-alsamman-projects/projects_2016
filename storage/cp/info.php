<? include("inc/header.php");
if(ch_start()==0){
	$add_opr=1;
}else{
	$add_opr=0;
}
$edit_opr=1;
$delete_opr=0;
$showID=0;
$title='Main Information';
$table="main_information";
$order="id";
$order_dir="ASC";
$rpp=20;//record per page
$user_id=$_SESSION['user_id'];
$condtion=" where user_id=".$_SESSION['user_id'];
$list_arr=array('user_id','photo','f_name','mail','site','phone','mobile','introdaction','career','other','facebook','twiter','linkedin','google');
$list_names=array('','Photo','Full Name','E mail','Website','Phone','Mobile','Introdaction','Career','Other','Facebook','Twiter','Linkedin','Google');
$list_type=array('m_id','photo','text','text','text','text','text','textarea','textarea','textarea','text','text','text','text'); 
$list_vld=array('','');
$list_par=array($user_id,'','','','','','','e1','e2','e3','','','','');
$list_show=array('0','1','1','1','1','1','1','0','0','0','0','0','0','0');

include("body.php");
include("inc/footer.php")?>
