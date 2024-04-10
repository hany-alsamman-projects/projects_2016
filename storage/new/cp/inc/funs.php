<? 
//ini_get('display_errors','off');
//error_reporting(7);
$maxImageSize=4400;
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
function checkUser($n){
	if($n!=$_SESSION['user_type']){
		session_destroy();
		echo "<script>document.location='login.php'</script>";
		exit();
	}
}
//***************************************************************/
function langs_list($s){
	global $langs,$lang_name;
	$res='<select name="lang">';

	for($i=0;$i<count($langs);$i++){
		$sel="";
		if($s==$langs[$i]){$sel="selected";}
		$res.='<option value="'.$langs[$i].'" '.$sel.'>'.$lang_name[$i].'</option>';
	}
	$res.='</select>';

	return $res;
}
//***************************************************************/
function lang_name($val){
	global $langs,$lang_name;
	for($i=0;$i<count($langs);$i++){
		if($val==$langs[$i]){
			$res=$lang_name[$i];
		}
	}
	return $res;
}
//***************************************************************/
function checkAjax(){
	if((isset($_SESSION['log']) || isset($_SESSION['login'])) && isset($_SESSION['user_id'])){
		return true;
	}else{
		return false;
	}	
}
//***************************************************************/
function view_list_type($type,$val,$par,$name,$id){	
	$res="";
	if($type=="text" ){
		if($val!=""){
			$res=$val;
		}else{
			$res="&nbsp;";
		}
	}
	if($type=="date"){
		$res=$val;
	}
	if($type=="act"){
		if($val==1){
			$res="<img src='images/1.png' />";
		}else{
			$res="<img src='images/0.png' />";
		}
	}
	if($type=="photo"){
		if($val){
			$image=resizeImage($val,"../uploads/",100,70,'image');
			$res='
			<img src="images/delete.png" title="'._delete_photo.'" class="hand" 
			onclick="delete_file(\''.$id.'\',\''.$name.'\',\''.$val.'\')" /><br><img src="'.$image.'"/>'; 
			
		}else{
			$res='&nbsp;';
		}
		
	}
	if($type=="parent"){
		$pars=explode('|',$par);
		$res=get_val($pars[0],$pars[1],$val);
	}
	if($type=="list"){
		$pars=explode('|',$par);
		for($i=0;$i<count($pars);$i++){
			$pars2=explode(':',$pars[$i]);
			if($val==$pars2[0]){
				$res=$pars2[1];
			}
		}
		
	}
	if($type=="textarea" ){
		if($val!=""){
			$res=$val;
		}else{
			$res="&nbsp;";
		}
	}
	if($type=="file" ){
		if($val!=""){
			$res='<a href="../uploads/'.$val.'" target="_blank" style="color:#00f">'.$val.'</a>';
		}else{
			$res="&nbsp;";
		}
	}
	if($type=="lang" ){
		if($val!=""){
			$res=lang_name($val);
		}else{
			$res="&nbsp;";
		}
	}
	if($type=="sun" ){
		$pars=explode('|',$par);
				
		$res='<a href="'.$pars[0].'?id='.$id.'" class="ex_link">'.$pars[2].' ('.getTotal($name,$pars[1],$id).')</a>'; 
		
	}
	if($type=="fun"){
		$pars=explode('|',$par);
		$res=$pars[0]($id);
	}		
	
	return $res;
}
function textareaC($v){
	//$v=nl2br($v);
	//$v=stripcslashes($v);
	$v=str_replace("\n",'&_&',$v);
	$v=str_replace("\r",'&_&',$v);
	return $v;
}
//***************************************************************/
function get_form_type($type,$name,$par){ 
	global $langs,$lang_name;
	$res="";
	if($type=="text"){
		$res='<input name="'.$name.'" type="text" class="text_f">';
	}
	if($type=="date"){
		$res='<input name="'.$name.'" type="text" class="text_f Date">';
	}
	if($type=="act"){
		$res='<input name="'.$name.'"  type="checkbox">';
	}
	if($type=="photo" || $type=="file"){
		$res='<input type="file" name="'.$name.'"> ';
	}
	if($type=="parent"){
		$pars=explode('|',$par);
		$res=make_Combo_box($pars[0],$pars[1],$pars[2],$pars[3],$name,0);
	}
	if($type=="list"){
		$res='<select name="'.$name.'">';
		$pars=explode('|',$par);
		for($i=0;$i<count($pars);$i++){
			$pars2=explode(':',$pars[$i]);
			$res.='<option value="'.$pars2[0].'">'.$pars2[1].'</option>';
		}

		$res.='</select>';
	}	
	if($type=="textarea"){
		$res='<textarea name="'.$name.'" class="text_area" style="width: 350px;"></textarea>';
	}
    
	if($type=="editor"){
		$res='<textarea name="'.$name.'" class="text_area" id="'.$par.'" style="width: 400px; height:200px;"></textarea>';
	}	
	if($type=="pass"){
		$res='<input name="'.$name.'"  type="password" class="text_f">';
	}	
	if($type=="lang"){
		$res='<select name="'.$name.'">';
		for($i=0;$i<count($langs);$i++){
			$res.='<option value="'.$langs[$i].'">'.$lang_name[$i].'</option>';
		}

		$res.='</select>';
	}
	return $res;
}
//***************************************************************/
function get_form_edit($type,$name,$par,$val=''){ 	
	$res="";
	if($type=="text"){
		$res='<input name="'.$name.'" id="e_'.$name.'" type="text" class="text_f" value="'.$val.'">';
	}
	if($type=="date"){
		$res='<input name="'.$name.'" id="e_'.$name.'" type="text" class="text_f Date" value="'.$val.'">';
	}
	if($type=="act"){
		$ch='';
		if($val==1){$ch=' cheched ';}
		$res='<input name="'.$name.'" id="e_'.$name.'" type="checkbox" '.$ch.'>';
		
	}
	if($type=="photo" || $type=="file"){
		$res='<input name="'.$name.'" id="e_'.$name.'" type="file" >
		<input name="old_'.$name.'" id="x_'.$name.'" type="hidden" value="'.$val.'" > ';
	}
	if($type=="parent"){
		$pars=explode('|',$par);
		$res=make_Combo_box($pars[0],$pars[1],$pars[2],$pars[3],$name,1);
	}	
	if($type=="list"){
		$res='<select name="'.$name.'" id="e_'.$name.'">';
		$pars=explode('|',$par);
		for($i=0;$i<count($pars);$i++){
			$pars2=explode(':',$pars[$i]);
			$res.='<option value="'.$pars2[0].'">'.$pars2[1].'</option>';
		}	
		$res.='</select>';
	}	
	if($type=="textarea"){
		$res='<textarea name="'.$name.'" class="text_area" id="e_'.$name.'" style="width: 350px;">'.stripslashes($val).'</textarea>';
	}	
	if($type=="pass"){
		$res='<input name="'.$name.'"  type="password" id="e_'.$name.'" class="text_f"/>
		<input name="x_'.$name.'" id="x_'.$name.'" type="hidden" class="text_f"/>';
	}
	if($type=="editor"){
		$res='<textarea name="'.$name.'" class="text_area" id="e_'.$par.'" style="width: 600px; height:200px;">'.stripslashes($val).'</textarea>';
	}		
	return $res;
}
//***************************************************************/
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
//***************************************************************/
function post_val($type,$name,$opr){
	if($type=="text"){
		$res=$_POST[$name];
	}
	if($type=="parent"){
		$res=$_POST[$name];
	}
	if($type=="date"){
		$val=$_POST[$name];
		if($val!=''){
			$res=convertData($val,1);
		}else{
			$res="";
		}
		//echo "(".$res.")";
	}
		
	if($type=="act"){
		if(isset($_POST[$name])){
			$res=1;
		}
	}
	if($type=="photo"){
		if($opr=='add'){
			if($_FILES[$name]['name']!=''){
				$up=uploadImage($name); 
				if($up >0 && $up<7 ){
					$res="xXx";			
				}else{
					$res=$up;
				}
			}
		}
		if($opr=='edit'){
			$new=$_FILES[$name]['name'];
			$old=$_POST['old_'.$name];
			if($new!=''){
				$up=uploadImage($name); 
				if($up >0 && $up<7 ){
					$res="xXx";			
				}else{
					$res=$up;
					if($old!=''){
						@unlink("../uploads/".$old);
					}
				}
			}else{
				$res=$old;
			}
		}
	}
	if($type=="file"){
		if($opr=='add'){
			if($_FILES[$name]['name']!=''){
				$up=uploadFile($name); 
				if($up >0 && $up<7 ){
					$res="xXx";			
				}else{
					$res=$up;
				}
			}
		}
		if($opr=='edit'){
			$new=$_FILES[$name]['name'];
			$old=$_POST['old_'.$name];
			if($new!=''){
				$up=uploadFile($name); 
				if($up >0 && $up<7 ){
					$res="xXx";			
				}else{
					$res=$up;
					if($old!=''){
						@unlink("../uploads/".$old);
					}
				}
			}else{
				$res=$old;
			}
		}
	}
	if($type=="list"){
		$res=$_POST[$name];
	}
	if($type=="textarea"){
		$res=addslashes($_POST[$name]);
	}
	if($type=="editor"){
		$res=addslashes($_POST[$name]);
	}
	if($type=="pass"){
		$pass=$_POST[$name];
		echo $pass;
		if($opr=='add'){			
			if($pass==''){				
				$res="xXx";			
			}else{
				$res=md5($pass);
			}
		}
		if($opr=='edit'){
			if($pass==''){
				$res=$_POST['x_'.$name];			
			}else{
				$res=md5($pass);
			}
		}
	}
	return $res;
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
function pagging($t,$rpp,$p){
	$more_pages=0;
	$str='';
	$mvp=10;//Max View Page
	if($t>$rpp){
		$str='<table border="0" align="center" class="pagging"><tr>';
		if($t%$rpp==0){
			$pages=$t/$rpp;
		}else{
			$pages=intval(($t/$rpp))+1;
		}
		$s_loop=0;
		$e_loop=$pages;
		if($mvp<$pages){
			$more_pages=1;
			$m_mvp=intval($mvp/2);
			if($p<=$m_mvp){
				$s_loop=0;
				$e_loop=$mvp;
			}else if($p>=($pages-$m_mvp)){
				$s_loop=$pages-$mvp;
				$e_loop=$pages;
				$more_pages=0;
			}else{
				$s_loop=$p-$m_mvp;
				$e_loop=$s_loop+$mvp;
			}
			
		}
		if($p!=0){$str.='<td onclick="selPage('.($p-1).')" ><div class="pageN"><div>'._priv.'</div></div></td>';}

		for($i=$s_loop;$i<$e_loop;$i++){
			if($p==$i){
				$str.= '<td ><div class="pageN_act"><div>'.($i+1).'</div></div></td>';
			}else{
				$str.= '<td  onclick="selPage('.$i.')"><div class="pageN"><div>'.($i+1).'</div></div></td>';
			}
		}
		if($more_pages){
			$str.='<td nowrap="nowrap" >';
			if($e_loop!=$pages){
				$str.='...'.$pages;
			}
			$str.='</td>';
		}
		if($p<$pages-1){$str.='<td onclick="selPage('.($p+1).')"><div class="pageN"><div>'._next.'</div></div></td>';}
		
	
	$str.='</tr></table>';
	}
	return $str;
}
//***************************************************************/
function getRandString($length){
    $ch = '0123456789abcdefghijklmnopqrstuvwxyz';
    $rand_name = '';    

    for ($p = 0; $p < $length; $p++) {
        $rand_name .= $ch[mt_rand(0, strlen($ch))];
    }
	return $rand_name;
}
//***************************************************************/
function uploadFile($file){
	global $maxImageSize;
	$rand_name= getRandString(20);
	$ret=0;
	if($_FILES[$file]["name"]!=""){
		$typeArr=array('swf','SWF','DOC','DOCX','doc','docx','pdf','PDF','jpg','png','jpeg','JPEG','JPG','PNG','gif','GIF');
		if ($_FILES[$file]["error"] > 0){
			$ret=1;
		}else{
			$type= explode(".",$_FILES[$file]["name"]);
			$ext=$type[count($type)-1];
			$name=$_FILES[$file]["name"];
			$size=$_FILES[$file]["size"] / 1024;
			$tamp=$_FILES[$file]["tmp_name"];
			$fileName="I".$rand_name.".".$ext;
			$fullFileName="../uploads/".$fileName;
			if (in_array($ext,$typeArr)){
				if($size < 2048){
					if (file_exists($fullFileName)){
						$ret=2;
			    	}else{
			    		if(move_uploaded_file($tamp,$fullFileName)){
							$ret=$fileName;
						}else{
							$ret=3;
						}
			    	}
				}else{
					$ret=4;
				}
			}else{
				$ret=5;
			}
		}
	}
	return $ret;
}
//***************************************************************/
function uploadImage($file){
	global $maxImageSize;
	$rand_name= getRandString(20);
	$ret=0;
	if($_FILES[$file]["name"]!=""){
		$typeArr=array('image/gif','image/JPEG','jpg','png','jpeg','JPEG','JPG','PNG','gif','GIF');
		if ($_FILES[$file]["error"] > 0){
			$ret=1;
		}else{
			$type= explode(".",$_FILES[$file]["name"]);
			$ext=$type[count($type)-1];
			$name=$_FILES[$file]["name"];
			$size=$_FILES[$file]["size"] / 1024;
			$tamp=$_FILES[$file]["tmp_name"];
			$fileName="I".$rand_name.".".$ext;
			$fullFileName="../uploads/".$fileName;
			if (in_array($ext,$typeArr)){
				if($size < 2048){
					if (file_exists($fullFileName)){
						$ret=2;
			    	}else{
			    		if(move_uploaded_file($tamp,$fullFileName)){
							if(getimagesize($fullFileName)){
								$imgeSizeChe=getimagesize($fullFileName);
								if($imgeSizeChe[0]+$imgeSizeChe[1] <$maxImageSize){
									$ret=$fileName;
								}else{
									$ret=7;
								}
							}else{
								$ret=6;
							}
							//resizeImage($fileName,"../uploadsPro/",200,200,"admin");
						}else{
							$ret=3;
						}
			    	}
				}else{
					$ret=4;
				}
			}else{
				$ret=5;
			}
		}
	}
	return $ret;
}
//***************************************************************/
function uploadMagz($file){
	global $maxImageSize;
	$rand_name= getRandString(20);
	$ret=0;
	if($_FILES[$file]["name"]!=""){
		$typeArr=array('jpeg','JPEG','JPG','jpg');
		if ($_FILES[$file]["error"] > 0){
			$ret=1;
		}else{
			$type= explode(".",$_FILES[$file]["name"]);
			$ext=$type[count($type)-1];
			$name=$_FILES[$file]["name"];
			$size=$_FILES[$file]["size"] / 1024;
			$tamp=$_FILES[$file]["tmp_name"];
			$fileName="I".$rand_name.".".$ext;
			$fullFileName="../uploads/mgz/".$fileName;
			if (in_array($ext,$typeArr)){
				if($size < 2048){
					if (file_exists($fullFileName)){
						$ret=2;
			    	}else{
			    		if(move_uploaded_file($tamp,$fullFileName)){
							if(getimagesize($fullFileName)){
								$imgeSizeChe=getimagesize($fullFileName);
								if($imgeSizeChe[0]+$imgeSizeChe[1] <$maxImageSize){
									$ret=$fileName;
								}else{
									$ret=7;
								}
							}else{
								$ret=6;
							}
							//resizeImage($fileName,"../uploadsPro/",200,200,"admin");
						}else{
							$ret=3;
						}
			    	}
				}else{
					$ret=4;
				}
			}else{
				$ret=5;
			}
		}
	}
	return $ret;
}
//***************************************************************/
function resizeImage($file,$path,$ww,$hh,$rename){
	global $maxImageSize;
	if(file_exists($path.$file)){
	if(!file_exists($path."resize/".$rename.$ww.$hh.$file)){
		$type= explode(".",$file);
		$ext=$type[count($type)-1];
		$fullFileName=$path.$file;
		$trans=0;
		list($w,$h)=@getimagesize($fullFileName);
		if($w+$h<$maxImageSize){
			if($ext == "jpeg" || $ext == "jpg" || $ext == "JPG"){
				$type=1;
				$new_img = @imagecreatefromjpeg($fullFileName);
			}elseif($ext == "png" || $ext == "PNG"){
				$trans=1;
				$type=2;
				$new_img = @imagecreatefrompng($fullFileName);
			}elseif($ext == "gif" || $ext == "GIF"){
				$trans=1;
				$type=3;
				$new_img = @imagecreatefromgif($fullFileName);
			}
			
			if($ww/$hh>$w/$h){
				$hhh=$hh;
				$www=round(($w*$hh)/$h);
			}
			if($ww/$hh<$w/$h){
				$www=$ww;
				$hhh=round(($h*$ww)/$w);
			}
			if($ww/$hh==$w/$h){
				$hhh=$hh;
				$www=$ww;
			}
			//Alert($www."|".$hhh);
			if (function_exists(imagecreatetruecolor)){
				$resized_img =  imagecreatetruecolor($www,$hhh);
			}else{
				die("Error: Please make sure you have GD library ver 2+");
			}
			 if($trans == 1){
				 imagealphablending($resized_img, false);
				 imagesavealpha($resized_img,true);
				 $transparent = imagecolorallocatealpha($resized_img, 255, 255, 255, 127);
				 imagefilledrectangle($resized_img, 0, 0, $www, $hhh, $transparent);
			 }
			//-------------------------------
			imagecopyresampled($resized_img,$new_img,0,0,0,0,$www,$hhh,$w,$h);
			if($type==1){imagejpeg ($resized_img,$path."resize/".$rename.$ww.$hh.$file);}
			if($type==2){imagepng ($resized_img,$path."resize/".$rename.$ww.$hh.$file);}
			if($type==3){imagegif ($resized_img,$path."resize/".$rename.$ww.$hh.$file);}
			
			ImageDestroy ($resized_img);
			ImageDestroy ($new_img);
			return $path."resize/".$rename.$ww.$hh.$file;
		}else{
			return false;
		}
	}
		return $path."resize/".$rename.$ww.$hh.$file;
	}else{
		return false;
	}
}
//***************************************************************/
function getsub3($sub,$cat){
	$sql="select addition_cat from category where id='$cat'";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows>0){
		$t=mysql_result($res,0,'addition_cat');
		if($t==1){
			$sql2="select area from areas where id='$sub'";
			$res2=mysql_query($sql2);
			$rows2=mysql_num_rows($res2);
			$str=mysql_result($res2,0,'area');
		}
		if($t==2){
			$sql2="select car_ar from cars where id='$sub'";
			$res2=mysql_query($sql2);
			$rows2=mysql_num_rows($res2);
			$str=mysql_result($res2,0,'car_ar');
		}
	}
	
	return $str;
}
//***************************************************************/
function dateToTime($d){
	$tt=0;
	$tt2=0;
	$tt3=0;
	$tt4=0;	
	$tt5=0;

	$str=$d." - From ";
	$c=0;
	$d=strtotime($d);   
		//echo $d;
	$tt=date("U")-$d;
	if($tt<0){$str.=$tt;}
	if($tt>60*60*24*365){
		$str.= "More than year";		
	}else{
		if($tt>60*60*24){
			$str.= intval($tt/60/60/24)." Days";
			$tt2=$tt-(intval($tt/60/60/24)*(60*60*24));
			$c++;
		}else{
			$tt2=$tt;
		}
		if($tt2>60*60){
			if($c<2){
				if($c>0){$str.=' - ';}
				$str.= intval($tt2/60/60)." Hours";
				$tt3= $tt2-(intval($tt2/60/60)*(60*60));
				$c++;
			}
		}else{
			$tt3=$tt2;
		}
		if($tt3>60){
			if($c<2){
				if($c>0){$str.=' - ';}
				$str.= intval($tt3/60)." Min";
				$tt4= $tt3-(intval($tt3/60)*(60));
				$c++;
			}
		}else{
			$tt4=$tt3;
		}
		if($tt4>0){
			if($c<2){
				if($c>0){$str.=' - ';}
				$str.=intval($tt4)." Sec";
			}
		}
	}
	
	return $str;
}
function dateToTimeS($d){
	$c=0;
	$str='';
	$tt=$d;
	if($tt>60*60*24*365){
		$str.= "أكثر من سنة";		
	}else{
		if($tt>60*60*24){
			$str= intval($tt/60/60/24)." يوم";
			$tt2=$tt-(intval($tt/60/60/24)*(60*60*24));
			$c++;
		}else{
			$tt2=$tt;
		}
		if($tt2>60*60){
			if($c<2){
				if($c>0){$str.=' - ';}
				$str.= intval($tt2/60/60)." ساعة";
				$tt3= $tt2-(intval($tt2/60/60)*(60*60));
				$c++;
			}
		}else{
			$tt3=$tt2;
		}
		if($tt3>60){
			if($c<2){
				if($c>0){$str.=' - ';}
				$str.= intval($tt3/60)." دقيقة";
				$tt4= $tt3-(intval($tt3/60)*(60));
				$c++;
			}
		}else{
			$tt4=$tt3;
		}
		if($tt4>0){
			if($c<2){
				if($c>0){$str.=' - ';}
				$str.=intval($tt4)." ثانية";
			}
		}
	}
	
	return $str;
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
//***************************************************************/
function msgTotal($table,$id,$co){
	$sql2="select count(*)C from $table  where user_id='$id' and $co=0";
	$res2=mysql_query($sql2);
	$total=mysql_result($res2,0,'C');
	return $total;
}

//***************************************************************/
function getMaxValOrder($m,$n){
	$sql="select ord from m_pages where mag_id='$m' and  num_id='$n' order by ord DESC limit 1";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows>0){
		$ord=mysql_result($res,0,'ord');
		$ord++;
	}else{
		$ord=1;
	}
	return $ord;
}
//***************************************************************/
function getMaxVal($p_id){
	$sql="select ord from menu where  p_id='$p_id' order by ord DESC limit 1";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows>0){
		$ord=mysql_result($res,0,'ord');
		$ord++;
	}else{
		$ord=1;
	}
	return $ord;
}
//***************************************************************/
function ch_start(){
	$user=$_SESSION['user_id'];
	$sql="select count(*)c from main_information where id = '$user'";
	$res=mysql_query($sql);
	return mysql_result($res,0,'c');
}
function chekQunt($ord_id,$id,$qunt,$r=0){
	//***********************INVICE***************************************
	$sql1="select sum(qunt) as q from inv_opr where it_id='$id' and ord_id='$ord_id'";
	$res1=mysql_query($sql1);
	$counts1=mysql_result($res1,0,'q');
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
function totalCost($inv_id,$item_id,$v_qunt,$order_id){
	$expenses=get_val('orders','expenses',$order_id);
	
	$sql="select sum(qunt*price) as tot from ord_opr  where ord_id='$order_id'   group by 'tot'";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows){
		$OrderCost= mysql_result($res,0,'tot');
	}	
	$sql2="select sum(qunt*price) as tot , qunt, price from ord_opr where ord_id='$order_id' and it_id='$item_id' group by 'tot'";
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);
	if($rows2){
		$OrderItemeCost= mysql_result($res2,0,'tot');
		$qunt= mysql_result($res2,0,'qunt');
		$price= mysql_result($res2,0,'price');
	}
	$startCost=$price*$v_qunt;
	$expensesCost=intval((($OrderItemeCost*$expenses)/$OrderCost)/$qunt)*$v_qunt;
	
	return $startCost+$expensesCost;
}
function getInviceBalance($id){
	$str=0;
	$sql2="select * from inv_opr v , items i , orders o , invices inv  where 
	v.it_id=i.id  and v.ord_id=o.id and v.inv_id=inv.id and	inv.id='$id'";
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);
	if($rows2>0){
		$i=0;	
		$total=0;
		$allSelesBalanceCost=0;
		$totalInvice=0;
		$totalInviceCost=0;
		$totalInviceSell=0;
		while($i<$rows2){
			$item_id=mysql_result($res2,$i,'i.id');
			$price=mysql_result($res2,$i,'v.price');
			$qunt=mysql_result($res2,$i,'v.qunt');
			$order_id=mysql_result($res2,$i,'o.id');
			$tot=$price*$qunt;
			$total=$total+$tot;			
			$totalSell=$price*$qunt;
			$totalCost=totalCost($id,$item_id,$qunt,$order_id);
			$Balance=$totalSell-$totalCost;
			$totalInvice=$totalInvice+$Balance;
			$totalInviceCost=$totalInviceCost+$totalCost;
			$totalInviceSell=$totalInviceSell+$totalSell;
			$i++;
		}
		 $str=$totalInvice;
	}
	return $str;
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
//***************************************************************/
function getMaxValOpr($table,$ord){
	$sql="select `$ord` from `$table` order by $ord DESC limit 1";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows>0){
		$ord1=mysql_result($res,0,$ord);
		$ord1++;
	}else{
		$ord1=1;
	}
	return $ord1;
}
//***************************************************************/
?>
