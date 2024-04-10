<?
function creatComboBox($table,$val,$colum,$name,$condtion){
	$str='';
	$sql="select * from $table $condtion order by $colum ASC";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	$str='<select name="'.$name.'" id="'.$name.'" class="select">';
	$str.='<option value="0">----------</option>';
	if($rows>0){		
		while($row=mysql_fetch_array($res)){
			$str.='<option value="'.$row[$val].'">'.$row[$colum].'</option>';
		}		
	}
	$str.='</select>';
	return $str;
}
function creatComboBoxScript($table,$val,$colum,$name,$condtion,$script){
	$str='';
	$sql="select * from $table $condtion order by $colum ASC";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	$str='<select name="'.$name.'" id="'.$name.'" class="select" onchange="'.$script.'">';
	$str.='<option value="0">----------</option>';
	if($rows>0){		
		while($row=mysql_fetch_array($res)){
			$str.='<option value="'.$row[$val].'">'.$row[$colum].'</option>';
		}		
	}
	$str.='</select>';
	return $str;
}
function get_val($table,$t_colum,$f_colum,$val){
	$sql="select $t_colum from $table where $f_colum='$val' limit 1 ";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows>0){
		return mysql_result($res,0,$t_colum);	
	}
}
function getNewId($table){
	$sql="SELECT MAX(id) AS i FROM $table";
	$res=mysql_query($sql);
	return mysql_result($res,0,'i')+1;
}
function getNewName($file){
	$check=0;
	$f=explode('.',$file);
	$ext=$f[count($f)-1];
	while($check==0){
		$newfile=getRandString(8).'.'.$ext;
		$sql="SELECT count(*)c from photos where photo='$newfile'";
		$res=mysql_query($sql);
		$c=mysql_result($res,0,'c');
		if($c==0){
			return $newfile;
			$check=1;
		}	
	}
	
}
function getRandString($length){
    $ch = '123456789abcdefghijklmnopqrstuvwxyz';
    $rand_name = '';    

    for ($p = 0; $p < $length; $p++) {
        $rand_name .= $ch[mt_rand(0, strlen($ch))];
    }
	return $rand_name;
}
//********************************************************************************************
$maxImageSize=100000;
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
?>