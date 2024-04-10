<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
$c=$_POST['c'];

$q='';
if($c!=0){
	/* $q=" and v.c_id='$c' "; */
}
$sql="select * from orders o , users u   where o.user_id=u.id and o.fin=0 $q order by date DESC";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
    if($rows>0){?>
        <div class="box g16">
            <h2 class="box-ttl">Show Orders</h2>
            <div class="box-body no-pad datatable-cont">
                <table class="display table" id="ShowOrders">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>#LOT</th>
                        <th>Data</th>
                        <th>Supplier</th>
                        <th>Shipping Company</th>
                        <th>Shipping Expenses</th>
                        <th>P.O</th>
                        <th>User</th>
                        <th>Tags</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody><?
                    $i=0;
                    while($i<$rows){
                        $id=mysql_result($res,$i,'o.id');
                        $name=mysql_result($res,$i,'o.name');
                        $date=mysql_result($res,$i,'o.date');
                        $user=mysql_result($res,$i,'u.fname');

                        $shipping_company =mysql_result($res,$i,'o.shipping_company');
                        $shipping_expenses=mysql_result($res,$i,'o.shipping_expenses');
                        $supplier_id = mysql_result($res,$i,'o.supplier');
                        if($supplier_id != false) $supplier= @mysql_result(mysql_query("select name from `suppliers` where `id` = '{$supplier_id}'"),0);
                        else $supplier = 'none';

                        $order_status =mysql_result($res,$i,'o.order_status');

                        $po=mysql_result($res,$i,'o.po');

                        if(($i%2)==0){$col='#cceecc';}
                        else{$col='#edfaed';}

                        if($order_status == 1){
                            $color = '#637911';
                            $tag = '<span class="tag green">delivered</span>';
                        }elseif($order_status == 2){
                            $color = '#9f301f';
                            $tag = '<span class="tag red">not delivered</span>';
                        }


                        ?><tr>
                        <td bgcolor="<?=$color?>"><?=$id?></td>
                        <td><?=$name?></td>
                        <td><?=$date?></td>
                        <td><?=$supplier?></td>
                        <td><?=$shipping_company?></td>
                        <td><?=$shipping_expenses?></td>
                        <td><?=$po?></td>
                        <td><?=$user?></td>
                        <td><?=$tag?></td>
                        <td style="width: 100px">
                            <img src="images/edit2.png" class="edit_order" id="<?=$id?>" title="Edit" alt="Edit" class="hand"/>
                            <img src="images/view2.png" id="<?=$id?>" title="View" alt="View" class="fetch_included_order"/>
                            <? if(canDelete($id)==0){?>
                                <img src="images/close.png" id="<?=$id?>" title="Delete" alt="Delete" class="delete_order"/>
                            <? }else{
                                if(canDelever($id)==0){
                                    ?><img src="images/delv.png" id="<?=$id?>" class="deliver_order" title="Deliver""/><?
                                }
                            }?>
                        </td>
                        </tr><?
                        $i++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?
    }else{echo "No results";}
}
?>