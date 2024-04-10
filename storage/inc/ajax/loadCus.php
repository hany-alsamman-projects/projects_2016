<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
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

    $sql="select *  from customers where act=1 order by company ASC";
    $res=mysql_query($sql);
    $rows=mysql_num_rows($res);
    $i=0;
    ?> <!-- <div style="margin-left:10px; font-size:18px;">CUSTOMERS
	
	<a href="#" onclick="resetAllcustomers()">[reset all customer]</a>
	
	</div> --><?
    $week_in_seconds = 7 * 24 * 60 * 60;
    while($r=mysql_fetch_array($res)){

        $c_id=$r['id'];
        $note=$r['note'];

        $date=$r['last_reset'];
        $sql4 = "select id, date from invices where c_id = '$c_id' AND
	 date <= NOW() AND date >= '$date'  order by date desc  ";

        $res4=mysql_query($sql4);
        $rows4=mysql_num_rows($res4);
        $lastInvice='-';

        $okToShow = array();
        $threshold_in_days = 7;
        $ith = 0;
        $min_inv_id = -1;
        if($rows4>0){

            $lastInvice=dateToTime(mysql_result($res4,0,'date'));
            /*
            while ($current_inv_id_date = mysql_result($res4, $ith,'date'))
            {

                $date1 = new DateTime($current_inv_id_date);
                $date2 = new DateTime;
                $interval = $date1->diff($date2);
                if ($interval->d <= $threshold_in_days){
                $okToShow[] = mysql_result($res4, $ith,'id');
            //
                }
                $ith ++;
            }*/
        }
        /*
        $okToShowOrStmt = " (";
        $fieldToWhere = " `inv` ";
        for ($j = 0; $j< $ith; $j++){
            $okToShowOrStmt .= $okToShowOrStmt.$fieldToWhere." like ".$okToShow[$j];
            if ($j < $ith - 1)
            $okToShowOrStmt .= " AND ";
        }
        $okToShowOrStmt .= " )";
        */

        $sql3="select  sum(pay) as p  from payments where cus='$c_id' ";
        $res3=mysql_query($sql3);
        $pays=mysql_result($res3,0,'p');


        $sql2="select sum(qunt*price) as a , sum(qunt) as q  from inv_opr o , invices inv where
	o.inv_id=inv.id and 
	inv.c_id='$c_id'";

        $res2=mysql_query($sql2);
        $rows=mysql_num_rows($res2);
        $counts=mysql_result($res2,0,'q');

        $total2=mysql_result($res2,$i,'a');
        $total=$total2-$pays;
        if(!$counts){$counts=0;}
        if(!$total){$total=0;}
        //echo"(".$counts.")";
        $col='#060';
        if($total==0){$col='#666';};
        if($total<0){$col='#900';};
        if($note!=''){$col='#009';};
        ?>

        <div class="g4 toggle customer_row"  id="customer_<?=$r['id']?>">
            <div class="box-ttl" style="text-align: center; height: 40px"><span id="customer_company_name"><?=$r['company']?></span><br><br><br>
                <!-- <span class="tag orange inline"><?=Price($total)?></span> -->
            </div>
        </div>
    <?
    }

}
?>
