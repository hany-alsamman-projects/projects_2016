<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
$id=-1;
if ( isset($_POST['id']) )
	$id=mysql_real_escape_string($_POST['id']);

$sql="select *  from customers where id='$id'";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
$i=0;
while($r=mysql_fetch_array($res)){
	$c_id=$r['id'];
	$col='#060';
	//if($total==0){$col='#666';};
	//if($total<0){$col='#900';};	
	?>
    <div class="cus_info_div">
    <div style="font-size:18px"><strong><?=$r['company']?></strong></div>
    <div style="font-size:18px"><?=$r['name']?></div>
    <div><strong>Phone :</strong> <?=$r['phone']?></div>
    <div><strong>Mobile :</strong> <?=$r['mobile']?></div>
    <div><textarea id="cus_note" class="note_area co5 ie" ><?=$r['note']?></textarea></div>
    <div  class="winButt co5 ie shadw5 fl" onclick="saveCusNote(<?=$r['id']?>)">Save</div>
    <div  class="winButt co5 ie shadw5 fl" onclick="document.getElementById('cus_info').style.display='none'">Close</div>
    <div  class="winButt co5 ie shadw5 fl" onclick="resetCusShit(<?=$r['id']?>)">Reset</div>
    
    </div>
    </div>	

<?
}
}
?>
