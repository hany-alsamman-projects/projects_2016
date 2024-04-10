<?
error_reporting(7);
$maxImageSize=4401;
$t= strtotime("now");
$today= date('Y-m-d h', $t+(60*60*12));
//error_reporting(1);

function CHECK_LAST_UPDATE($table){
    $get_table_status = mysql_query("show table status from `storage` like '{$table}'");

    $check = mysql_fetch_assoc($get_table_status);

    return $check['Update_time'];
}

function COUNT_LOT_NO($id){


	//***********************INVICE***************************************
	$sql1="select sum(qunt) as q from inv_opr where it_id='$id'";
	$res1=mysql_query($sql1);
	$counts1=mysql_result($res1,0,'q');
	//***********************ORDER***************************************
	$sql2="select sum(qunt) as q from ord_opr where it_id='$id'";
	$res2=mysql_query($sql2);
	$counts2=mysql_result($res2,0,'q');
	//***********************XINVICE***************************************
	$sql3="select sum(qunt) as q from inv_porx where it_id='$id'";
	$res3=mysql_query($sql3);
	$counts3=mysql_result($res3,0,'q');
	//***********************DAMAGE***************************************
	$sql4="select sum(qunt) as q from dmg_opr where it_id='$id'";
	$res4=mysql_query($sql4);
	$counts4=mysql_result($res4,0,'q');
		
	$counts=$counts2-($counts4+$counts3+$counts1);	
	if(!$counts){$counts=0;}

	return $counts;

}

function login($n){
	$log=false;
	if (isset($_SESSION[$n]) && $_SESSION[$n]=='OK'){
		$log=true;	
	}
	if($_SESSION['user_id']=='' || $_SESSION['user_id']==0){
		$log=false;
	}
	if($log==false){
		session_destroy();
		header('Location:login.php');
		exit();
	}
}
function ceckAjax($n){
	$log=false;
	if (isset($_SESSION[$n]) && $_SESSION[$n]=='OK'){
		$log=true;	
	}
	if($_SESSION['user_id']=='' || $_SESSION['user_id']==0){
		$log=false;
	}
	if($log==false){
		session_destroy();
	}
	return $log;
}
//***************************************************************/
function make_Combo_box($table,$name,$val,$condtion,$filed,$edit){
	$ret="";
	$sql="select * from $table $condtion order by $name ASC";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows>0){
		$ret.='<select name="'.$filed.'"';
		if($edit){
			$ret.=' id="e_'.$filed.'"';
		}
		$ret.=' >';
		while($rows=mysql_fetch_array($res)){
			$ret.='<option value="'.$rows[$val].'">'.$rows[$name].'</option>';
		}	
		$ret.='</select>';
	}
	
	//return $table;
	return $ret;
}
//***************************************************************/
function make_Combo_box2($table,$name,$val,$condtion,$filed,$edit,$script,$dir,$de_val){
	$ret="";
	$sql="select * from $table $condtion order by id $dir";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows>0){
		$ret.='<select '.$script.' name="'.$filed.'" id="'.$filed.'" >';
		while($rows=mysql_fetch_array($res)){
			$ret.='<option value="'.$rows[$val].'"';
			if($de_val==$rows['id']){
				$ret.=' selected ';
			}
			$ret.='>'.$rows[$name].'</option>';
		}	
		$ret.='</select>';
	}
	
	//return $table;
	return $ret;
}
//***************************************************************/
function get_val($table,$name,$id){
	$ret="";
	$sql="select $name from $table where id='$id' limit 1";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows>0){
		$ret=mysql_result($res,0,$name);
	}
	return $ret;
}
//***************************************************************/
function get_val2($table,$name,$id,$co){
	$ret="";
	$sql="select $name from $table where $co='$id' limit 1";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows>0){
		$ret=mysql_result($res,0,$name);
	}
	return $ret;
}
//***************************************************************/
function saveString($str){
	$str=strip_tags($str);
	$str=addslashes($str);
	return $str;
}
//********************************************************************************************
function E_mail($subject,$to,$from,$msg){
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";	
	//$headers .= 'To: '.$to. "\r\n";
	$headers .= 'From: '.$from . "\r\n"; 
	if(@mail($to, $subject, $msg, $headers)){
		return 1;
	}else{
		return 0;
	}	
}
//********************************************************************************************
function getMonth($n,$lang){
	if($lang=='en'){
		$months=array('','January','February','March','April','May','June','July','August','September','October','November','December');
	}else{
		$months=array('','كانون الثاني','شباط','آذار','نيسان','أيار','حزيران','تموز','آب','أيلول','تشرين الأول','تشرين الثاني','كانون الأول');
	}
	if(substr($n,0,1)==0){
		$n=substr($n,1,1);
	}
	return $months[$n];
}
function check_email_address($email) {
	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
		return false;
	}
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",$local_array[$i])){
			return false;
		}
	}
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])){
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return false; // Not enough parts to domain
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|↪([A-Za-z0-9]+))$",$domain_array[$i])){
				return false;
			}
		}
	}
	return true;
}

function words($val,$words){
	$str='';
	$allWords=explode(' ',$val);
	if(count($allWords)<$words){
		$str=$val;
	}else{
		for($i=0;$i<$words;$i++){
			$str.=$allWords[$i].' ';
		}
		$str.=' ....';
	}
	return $str;
}

function convertData($val,$sw){
	if($sw==1){
		$y=substr($val,6,4);
		$m=substr($val,3,2);
		$d=substr($val,0,2);
		$str=$y."-".$d."-".$m;		
	}else{
		$y=substr($val,0,4);
		$m=substr($val,8,2);
		$d=substr($val,5,2);
		$str=$d."/".$m."/".$y;
	}
	return $str;
}


function Chuser(){
	$r=0;
	if(isset($_REQUEST['u'])){
		$u=$_REQUEST['u'];
		$sql="select * from users  where short='$u' and user_type=1 ";
		$res=mysql_query($sql);
		$rows=mysql_num_rows($res);
		if($rows>0){
			$r=mysql_result($res,0,'id');
			$act=mysql_result($res,0,'act');
			if($act==0){
				$r='x';
			}
		}
	}
	return $r;
}
//***************************************************************/
function getTotal($table,$fild,$val){
	if($fild!=0){
		$sql2="select count(*) C from $table ";
	}else{
		$sql2="select count(*) C from $table where $fild='$val'";
	}
	$res2=mysql_query($sql2);
	$total=mysql_result($res2,0,'C');
	return $total;
}
function loadInvice($user_id){
	$str='';
	$sql="select * from inv_porx x , orders o, items i  where 
	x.user_id='$user_id' and
	x.ord_id=o.id and 
	x.it_id=i.id order by x.date ASC
	";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows>0){
		$str.='<table id="t_invice" cellpadding="5" cellspacing="1">
		<tr><th >#LOT</th><th>Iteme</th><th>Quant</th><th>Price</th><th>Totla</th><th>Delete</th></tr>';
        $i=0;
		$ttt=0;
		$ids=array();
		while($rows>$i){
			$X_id=mysql_result($res,$i,'x.id');
			$it_id=mysql_result($res,$i,'x.it_id');
			/*array_push($ids,$it_id);	*/		
			$ord=mysql_result($res,$i,'o.name');
			$iteme=mysql_result($res,$i,'i.name');
            $qunt=mysql_result($res,$i,'x.qunt');
            $price=mysql_result($res,$i,'x.price');
			$date=mysql_result($res,$i,'x.date');
			$dateNOW=date('U');
			$dateT=$dateNOW-$date;
			$tt=$price*$qunt;
			$ttt=$ttt+$tt;
			$str.='
            <tr><td>'.$ord.'</td>
            <td align="center">'.$iteme.'</td>
            <td align="center">'.$qunt.'</td>
            <td align="center">$'.$price.'</td>
            <td align="center">$'.$tt.'</td>
            <td align="center">
			<img src="images/delete.png" border="0" style="cursor:pointer" onclick="DelInvIt(\'x\','.$X_id.')"/>
			</td></tr>';
			$i++;
		}
         $str.='<tr><td colspan="6" align="right"><strong style="font-size:16px">Invice Total : $'.$ttt.'</strong></td></tr>
		</table>
		<div class="save co5 ie fl " id="save_inv" onclick="saveInvice(1)">Save</div>
		<div class="save co5 ie fl"  onclick="DelInvIt(\'c\',0)()">Cancel</div>		
		';		
	}
	return $str;
}
function checkTimeOutInvice(){
	$str='';
	$xTime=900;
	$sql="select id , user_id , max(date) as `d` from inv_porx where date   
	group by user_id 	";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows>0){
		$str.='';
        $i=0;
		$ttt=0;
		$ids=array();
		while($rows>$i){
			$user_id=mysql_result($res,$i,'user_id');
			$date=mysql_result($res,$i,'d');
			$dateNOW=date('U');
			if($dateNOW-$date>$xTime){			
				$sql2="delete from inv_porx where user_id='$user_id' ";
				$res2=mysql_query($sql2);
			}
			$i++;
		}
	}
	return $str;
}
function not_select($ord_id,$it_id,$user_id){
	$sql="select count(*) as c from inv_porx where  user_id='$user_id' and  it_id='$it_id' and ord_id='$ord_id'";
	$res=mysql_query($sql);
	return mysql_result($res,0,'c');
}
function chekQunt($ord_id,$id,$qunt,$r=0){
	//***********************INVICE***************************************
	$sql1="select sum(qunt) as q from inv_opr where it_id='$id' and ord_id='$ord_id'";
	$res1=mysql_query($sql1);
	$counts1=mysql_result($res1,0,'q');
	//echo "(".$counts1.")";
	//***********************ORDER***************************************
	$sql2="select sum(qunt) as q from ord_opr where it_id='$id' and ord_id='$ord_id'";
	$res2=mysql_query($sql2);
	$counts2=mysql_result($res2,0,'q');
	//***********************XINVICE***************************************
	$sql3="select sum(qunt) as q from inv_porx where it_id='$id' and ord_id='$ord_id'";
	$res3=mysql_query($sql3);
	$counts3=mysql_result($res3,0,'q');
	//***********************DAMAGE***************************************
	$sql4="select sum(qunt) as q from dmg_opr where it_id='$id' and ord_id='$ord_id'";
	$res4=mysql_query($sql4);
	$counts4=mysql_result($res4,0,'q');
		
	$counts=$counts2-($counts4+$counts3+$counts1);	
	if(!$counts){$counts=0;}
	//*********************************************************************
	if($r==0){
		if($qunt<=$counts){return 1;}else{return 0;}
	}else{
		return $counts;
	}
}
function canDelete($id){
	$sql="select count(*) c from inv_opr where ord_id='$id'";
	$res=mysql_query($sql);
	$rows=mysql_result($res,0,'c');
	
	$sql2="select count(*) c from inv_opr where ord_id='$id'";
	$res2=mysql_query($sql2);
	$rows2=mysql_result($res2,0,'c');	
	return $rows+$rows2;
}
function canDelever($id){
	$sql2="select * from ord_opr where ord_id='$id'";
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);
	$i=0;
	$balance=0;
	while($i<$rows2){
		$item_id=mysql_result($res2,$i,'it_id');
		$qunt=mysql_result($res2,$i,'qunt');
		$balance=$balance+chekQunt($id,$item_id,$qunt,1);		
		$i++;
	}	
	return $balance;
}
function Price($n){
	$n =intval($n*100)/100;
	$nn=explode('.',$n);
	$num=$nn[0];
	$len=strlen($num);
	$out='$'.number_format($num);
	if(count($nn)>1){
		$out.='.'.$nn[1];
		if(strlen($nn[1])==1){
			$out.='0';
		}
	}else{
		$out.='.00';
	}
	return $out;
}
function dateToTime($d){
	$tt=0;
	$tt2=0;
	$tt3=0;
	$tt4=0;	
	$tt5=0;

	$str='';
	$c=0;
	$d=strtotime($d);   
		//echo $d;
	$tt=date("U")-$d;
	if($tt<0){$str.=$tt;}
	if($tt>60*60*24*365){
		$str.= "more than year";		
	}else{
		if($tt>60*60*24){
			$str= intval($tt/60/60/24)."D";
			$tt2=$tt-(intval($tt/60/60/24)*(60*60*24));
			$c++;
		}else{
			$tt2=$tt;
		}
		if($tt2>60*60){
			if($c<2){
				if($c>0){$str.='|';}
				$str.= intval($tt2/60/60)."H";
				$tt3= $tt2-(intval($tt2/60/60)*(60*60));
				$c++;
			}
		}else{
			$tt3=$tt2;
		}
		if($tt3>60){
			if($c<2){
				if($c>0){$str.='|';}
				$str.= intval($tt3/60)."M";
				$tt4= $tt3-(intval($tt3/60)*(60));
				$c++;
			}
		}else{
			$tt4=$tt3;
		}
		if($tt4>0){
			if($c<2){
				if($c>0){$str.='|';}
				$str.=intval($tt4)."S";
			}
		}
	}
	
	return $str;
}
?>
