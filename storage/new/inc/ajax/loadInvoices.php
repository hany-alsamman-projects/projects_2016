<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
    $type=$_SESSION['type'];
    $user_id=$_SESSION['user_id'];
    $c= 0;
    if (isset($_POST['c']))
        $c=mysql_real_escape_string($_POST['c']);

    $q='';
    if($c!=0){
        $q=" and v.c_id='$c' ";
    }
    $q2='';
    if($type!=2){
        $q2="and v.user_id=".$user_id;
    }
    $sql="select * from invices v , customers c , users u   where v.user_id=u.id and v.c_id=c.id and v.fin=0 $q $q2 order by date DESC";
    $res=mysql_query($sql);
    $rows=mysql_num_rows($res);
    if($rows>0){?>
        <div class="box g16">
            <h2 class="box-ttl">Show Invoices</h2>
            <div class="box-body no-pad datatable-cont">
                <table class="display table" id="ShowInvoices">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>Customer</th>
                        <th>Data</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody><?
                    $i=0;
                    while($i<$rows){
                        $id=mysql_result($res,$i,'v.id');
                        $name=mysql_result($res,$i,'c.company');
                        $date=mysql_result($res,$i,'v.date');
                        $user=mysql_result($res,$i,'u.fname');
                        if(($i%2)==0){$col='gradeX';}
                        else{$col='gradeC';}
                        ?><tr class="<?=$col?>">
                        <td><?=$id?></td>
                        <td><?=$name?></td>
                        <td><?=$date?></td>
                        <td><?=$user?></td>
                        <td style="width: 100px">
                            <!--<img src="images/delet.png" title="Delete" alt="Delete" class="hand" onclick="delInvice(<?=$id?>)" />
                            <img src="images/edit2.png" title="Edit" alt="Edit" class="hand"  onclick="editInvice(<?=$id?>)"/>
                            <img src="images/view2.png" title="View" alt="View" class="hand"  onclick="viewInvice(<?=$id?>)"/>
                             <img src="images/delv.png" title="Deliver" alt="View" class="hand"  onclick="deliver(1,<?=$id?>,'v')"/>
                            -->
                            <a href="print.php?v=<?=$id?>" target="_blank"><img src="images/print.png" border="0" title="Print" alt="View" class="hand" /></a>

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