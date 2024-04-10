<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
	checkTimeOutInvice();
	$user_id=$_SESSION['user_id'];
	$p=$_POST['p'];
	if(isset($_POST['p']) && $_POST['p']!=0){			
		$p2=explode('^',$p);
		$inv_p=explode('|',$p2[0]);
		$it_id=$inv_p[0];
		$price=$inv_p[1];
		$date=date('U');
		for($i=1;$i<count($p2);$i++){
			$p3=explode('|',$p2[$i]);
			$ord_id=$p3[0];
			$qunt=$p3[1];
			chekQunt($ord_id,$it_id,$qunt);
			if(chekQunt($ord_id,$it_id,$qunt)==1){
				$sql2="INSERT INTO `inv_porx` (`user_id`,`ord_id`,`it_id`,`qunt`,`price`,`date`)
				values('$user_id','$ord_id','$it_id','$qunt','$price','$date')";
				$res2=mysql_query($sql2);			
			}
		}		
	}
	echo loadInvice($user_id);

}
?>
