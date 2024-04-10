<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){

	 $result=mysql_query("select * from `suppliers` ORDER BY name ASC");
	 $rows=mysql_num_rows($result);
 	 echo '<select name="supplier" id="supplier_dd" class="drop select validate[required] g5">';
	 if($rows>0){
	    while($row = mysql_fetch_object($result)){
		echo '<option value="'.$row->id.'">'.$row->name.'</option>';
	    }
	 }
	 echo '</select>';
}

?>
