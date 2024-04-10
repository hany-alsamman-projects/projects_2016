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
                        <th>Tags</th>
                        <th style="width: 170px">Action</th>
                    </tr>
                    </thead>
                    <tbody><?
                    $i=0;
                    while($i<$rows){
                        $id=mysql_result($res,$i,'v.id');
                        $name=mysql_result($res,$i,'c.company');
                        $date=mysql_result($res,$i,'v.date');
                        $user=mysql_result($res,$i,'u.fname');
                        $invoice_status =mysql_result($res,$i,'v.invoice_status');
                        if(($i%2)==0){$col='gradeX';}
                        else{$col='gradeC';}

                        if($invoice_status == 1){
                            $color = '#637911';
                            $tag = '<span class="tag green">delivered</span>';
                        }elseif($invoice_status == 2){
                            $color = '#9f301f';
                            $tag = '<span class="tag red">not delivered</span>';
                        }elseif($invoice_status == 3){
                            $color = '#a9780d';
                            $tag = '<span class="tag orange">partial delivery</span>';
                        }

                        ?>

                        <tr class="<?=$col?>">
                        <td style="background-color: <?=$color?>"><?=$id?></td>
                        <td><?=$name?></td>
                        <td><?=$date?></td>
                        <td><?=$user?></td>
                        <td>
                            <?=$tag?>
                        </td>
                        <td style="width: 100px">
                            <img src="images/edit2.png" class="edit_invoice" id="<?=$id?>" title="Edit" alt="Edit"  />
                            <img class="fetch_included_invoice" id="<?=$id?>" src="images/view2.png" title="View" alt="View" />
                            <?
                           //if(canDelever($id)){
                                echo '<img class="deliver_invoice" id="'.$id.'" src="images/delv.png" title="deliver" alt="View" />';
                           // }
                            ?>
                            <a href="print.php?v=<?=$id?>" target="_blank"><img src="images/print.png" border="0" title="Print" alt="View" class="hand" /></a>
                            <img class="delete_invoice" id="<?=$id?>" src="images/close.png" title="Delete" alt="Delete" />

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