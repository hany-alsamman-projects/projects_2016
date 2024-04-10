<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
    checkTimeOutInvice();
    if (isset($_POST['a']) ) {
        $a=mysql_real_escape_string($_POST['a']);
    }
    else
    {
        $a=0;
    }

    if (isset($_POST['p']) ) {
        $p=mysql_real_escape_string($_POST['p']);
    }
    else
    {
        $p=0;
    }
    $sql="select *  from items where act=1 order by name ASC";
    $res=mysql_query($sql);
    $rows=mysql_num_rows($res);

    ?><script>var data =new Array();</script>

    <?
    $i=0;
while($i<$rows){
    $id=mysql_result($res,$i,'id');
    $getname=mysql_result($res,$i,'name');
    $price=mysql_result($res,$i,'price');


    $name = str_replace("'", '', $getname);
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
    //*********************************************************************
    $col='#060';

    if($counts==0){$col='#666';};
    if($counts<0){$col='#900';};?>

    <script>
        var OBJ=new Object();
        OBJ['id']=<?=$id?>;
        OBJ['total']=<?=$counts?>;
        OBJ['name']='<?=$name?>';
        OBJ['price']='<?=$price?>';
        data[<?=$id?>]=OBJ;

    </script>


    <div class="box g4 row6 item_row" id="item_<?=$id?>">
        <div class="box-ttl row6" ><?=$name?><br><br><br>
            <span class="tag blue inline"><?=Price($price)?></span><span class="tag green inline"><?=$counts?></span></div>
    </div>

    <?
    $i++;
}
}
?>