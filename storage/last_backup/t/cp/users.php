<? include("inc/header.php");
checkUser(2);
$add_opr=1;
$edit_opr=1;
$delete_opr=1;
$showID=0;
$title='Users';
$table="users";
$order="id";
$order_dir="ASC";
$rpp=10;//record per page
function showBalance($id){
	$sql="select sum(o.qunt*o.price) as tot from inv_opr o , invices v ,users u  where 
	u.id=v.user_id and 
	u.id='$id' and 
	v.id=o.inv_id   
	group by 'tot'";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows){$tot= mysql_result($res,0,'tot');}
	return '<div style="color:#090" ><b>'.Price($tot).'</b></div>';
}
$condtion="";
$list_arr=array('fname','un','pw','user_type','act','Balance');
$list_names=array('Full Name','User Name','Password','User Type','Ative','Balance');
$list_type=array('text','text','pass','list','act','fun'); 
$list_vld=array('','');
$list_par=array('','','','1:USER|2:ADMAIN|3:Accounting','','showBalance');
$list_show=array('1','1','0','1','1','1');

include("body.php");
include("inc/footer.php")?>
