<? include("inc/header.php");
$add_opr=0;
$edit_opr=0;
$view_opr=2;
$delete_opr=0;
$showID=0;
$title='Customers';
$table="customers";
$order="name";
$order_dir="ASC";
$view_link="customersPay.php";
$rpp=50;//record per page
function showBalance($id){
	$sql="select sum(o.qunt*o.price) as tot from inv_opr o , invices v   where v.c_id='$id' and v.id=o.inv_id   group by 'tot'";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows){$buy= mysql_result($res,0,'tot');}
	if(!$buy)$buy=0;
	
	$sql2="select sum(pay) as tot from payments where cus='$id' ";
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);
	if($rows2){$pay= mysql_result($res2,0,'tot');}	
	if(!$pay)$pay=0;
	$res=$pay-$buy;

	if($res>0){return '<div style="color:#090" ><b>'.Price($res).'</b></div>';}
	if($res==0){return '<div style="color:#000" ><b>'.Price($res).'<b></div>';}
	if($res<0){return '<div style="color:#900" ><b>'.Price($res).'<b></div>';}	

}
$condtion="";
$list_arr=array('company','name','phone','mobile','Balance');
$list_names=array('Company','Contant','Phone','Mobile','Balance');
$list_type=array('text','text','text','text','fun'); 
$list_vld=array('','','','','');
$list_par=array('','','','','showBalance');
$list_show=array('1','1','1','1','2'); 
include("body.php");
include("inc/footer.php")?>
