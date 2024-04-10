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
                        <th>User</th>
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
                        if(($i%2)==0){$col='#cceecc';}
                        else{$col='#edfaed';}
                        ?><tr bgcolor="<?=$col?>">
                        <td><?=$id?></td>
                        <td><?=$name?></td>
                        <td><?=$date?></td>
                        <td><?=$user?></td>
                        <td style="width: 100px">
                            <img src="images/edit2.png" title="Edit" alt="Edit" class="hand"  onclick="editOrder(<?=$id?>)"/>
                            <img src="images/view2.png" title="View" alt="View" class="hand"  onclick="viewOrder(<?=$id?>)"/>
                            <? if(canDelete($id)==0){?>
                                <img src="images/delet.png" title="Delete" alt="Delete" class="hand" onclick="delOrder(<?=$id?>)" />
                            <? }else{
                                if(canDelever($id)==0){
                                    ?><img src="images/delv.png" title="Deliver" alt="View" class="hand"  onclick="deliver(1,<?=$id?>,'o')"/><?
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