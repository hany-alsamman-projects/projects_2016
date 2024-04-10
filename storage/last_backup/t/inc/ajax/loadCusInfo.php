<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
$id= $_REQUEST['id'];

$sql="select *  from customers where id='$id' limit 1";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
$i=0;
if($r=mysql_fetch_array($res)){
	$c_id=$r['id'];
	?>

    <div style="height: 100%">
    <div><h2><?=$r['company']?> (<?=$r['name']?>)</h2></div>
    <div><b>Phone :</b> <?=$r['phone']?></div>
    <div><b>Mobile :</b> <?=$r['mobile']?></div>
    <div><b>Address :</b> <?=$r['address']?></div>
    <div class="cus_info_area" style="">
        <p class="clear"><textarea id="<?=$r['id']?>" class="note_area input g10 co5 ie" ><?=$r['note']?></textarea></p>
        <div class="box btn-box">
            <button type="submit" id="save_note" class="green btn-m flt-l g5 normal">Save</button>
            <button type="submit" id="view_note_invoice" class="blue btn-m flt-l g10 normal">view invoices</button>
        </div>
    </div>
    </div>
    </div>

<?
}
}
?>
