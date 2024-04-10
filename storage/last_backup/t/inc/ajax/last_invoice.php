<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){

    if (isset($_POST['id']))
        $id= $_POST['id'];

    $sql="select * from customers WHERE id='$id' limit 1";
    $res=mysql_query($sql);
    $rows=mysql_num_rows($res);
    if($rows>0){
        $id=mysql_result($res,0,'id');
        $name=mysql_result($res,0,'company');

    echo '<div>
    <div style="margin:15px; font-size:18px;">
    <strong>Customer #ID:</strong> '.$id.'<br>
    <strong>Full Name:</strong> '.$name.'<br>
    </div>';
    }


        $sql="select * from invices v , customers c , users u   where v.user_id=u.id and v.c_id=c.id and v.fin=0 and v.c_id='$id' order by date DESC";
        $res=mysql_query($sql);
        $rows=mysql_num_rows($res);
        if($rows>0){
            echo '<table align="center" width="800" ><tr>
            <th>NO</th><th>Customer</th><th>Date</th><th>User</th><th>&nbsp;</th></tr>';
            $i=0;
            while($i<$rows){
                $id=mysql_result($res,$i,'v.id');
                $name=mysql_result($res,$i,'c.company');
                $date=mysql_result($res,$i,'v.date');
                $user=mysql_result($res,$i,'u.fname');

                $invoice_status =mysql_result($res,$i,'v.invoice_status');

                if($invoice_status == 1){
                    $color = '#637911';
                }elseif($invoice_status == 2){
                    $color = '#9f301f';
                }elseif($invoice_status == 3){
                    $color = '#a9780d';
                }

                ?><tr bgcolor="<?=$color?>">
                <td><?=$id?></td>
                <td><?=$name?></td>
                <td><?=$date?></td>
                <td><?=$user?></td>
                <td width="150">
                    <img src="images/edit2.png" class="edit_invoice" id="<?=$id?>" title="Edit" alt="Edit"  />
                    <img class="fetch_included_invoice" id="<?=$id?>" src="images/view2.png" title="View" alt="View" />
                    <?
                    echo '<img class="deliver_invoice" id="'.$id.'" src="images/delv.png" title="deliver" alt="View" />';
                    ?>
                    <a href="print.php?v=<?=$id?>" target="_blank"><img src="images/print.png" border="0" title="Print" alt="View" class="hand" /></a>
                    <img class="delete_invoice" id="<?=$id?>" src="images/close.png" title="Delete" alt="Delete" />

                </td>
                </tr><?
                $i++;
            }
            echo '</table>';
        }else{
            echo "No results";
        }

    }
    ?>