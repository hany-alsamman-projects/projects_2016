<?

include('../../min/dbc.php');
include('../../inc/funs.php');

function create_invoice_row($item_id,$inv_id,$c){

    $id = $item_id;

    $fileds = array('item', 'dropdown', 'qun', 'price', 'total', 'action');

    $html = '<tr id="row_'.$id.'">';

    foreach($fileds as $key){

        $html .= '<td style="padding-top:6px; position: relative;" id="'.$key.'_'.$id.'">';

        if($key == 'item'){

            $item = mysql_result(mysql_query("select name from `items` WHERE `id` = '{$id}' "), 0);

            $html .= "<span>$item</span>";
            $html .= '<input type="hidden" name="'.$key.'[]" value="'.$id.'" >';


        }elseif($c == true && $key == 'dropdown'){

            $html .= '<div style="position: relative" ><select style="width:100px; margin-bottom: 20px" id="order_'.$id.'" name="order_id[]" class="drop select g3">';

            $sql="select * from orders o,ord_opr p where o.fin='0' and p.it_id='$id' and o.id=p.ord_id  order by date ASC";
            $res=mysql_query($sql);
            $rows=mysql_num_rows($res);
            $i=0;
            while($i<$rows){
                $c_id=mysql_result($res,$i,'o.id');
                $name=mysql_result($res,$i,'o.name');
                $q=chekQunt($c_id,$id,0,1);
                if($c==$c_id) $selected = 'selected';
                $html .= '<option value="'.$c_id.'" '.$selected.'><b>#'.$name.'</b> ['.$q.']</option>';
                $i++;
            }

            $html .= '</select></div>';

        }elseif($key == 'qun'){

            // i add price to calculate price*quantity
            $qunt = mysql_result(mysql_query("SELECT qunt FROM `inv_opr` WHERE `inv_id` = '{$inv_id}' and `it_id` = '{$id}' "), 0);

            $html .= '<div style="position: relative; height:50px" ><input autocomplete="off" style="position: absolute; top:0; width:55px" class="check_quantity required number" value="'.$qunt.'" id="'.$id.'" name="'.$key.'[]" ></div>';

        }elseif($key == 'price'){

            $price = mysql_result(mysql_query("select price from `items` WHERE `id` = '{$id}' "), 0);

            $html .= '<div style="position: relative; height:50px" ><input style="width:45px" name="'.$key.'[]" value="'.$price.'" ></div>';

        }elseif($key == 'total'){

            // i add price to calculate price*quantity
            $qunt = mysql_result(mysql_query("SELECT qunt FROM `inv_opr` WHERE `inv_id` = '{$inv_id}' and `it_id` = '{$id}' "), 0);
            $price = mysql_result(mysql_query("select price from `items` WHERE `id` = '{$id}' "), 0);

            $html .= $qunt*$price;

        }elseif($key == 'action'){

            $html .= '<a href="#" id="'.$id.'" class="remove_item"><img src="images/delete.png"></a>';

        }

        $html .= '</td>';

    }

    $html .= '</tr>';

    echo $html;

    unset($html);
}


$id=$_REQUEST['id'];
$sql="select * from invices v , customers c  where  v.c_id=c.id and v.id='$id' limit 1";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows>0){
	$id=mysql_result($res,0,'v.id');
	$name=mysql_result($res,0,'c.company');
	$c_id=mysql_result($res,0,'c_id');
    $invoice_status = mysql_result($res,0,'v.invoice_status');

    $get_payment = @mysql_query("SELECT * FROM `payments` WHERE `inv` = '{$id}' limit 1");

    $pay = @mysql_result($get_payment,0,'pay');
    $note = @mysql_result($get_payment,0,'note');

    echo '<div id="smp-form" class="box g8 flt-l edit_invoice_form">
                <p class="box-ttl">Edit Invoice NO# '.$id.' <img src="images/close.png" alt="" class="close_edit_invoice flt-r"></p>
        <div class="box-body">

                    <form id="edit-invoice-form">

                        <div id="box_customer_name"><h2><span>'.$name.'</span></h2></div>
                        <hr>

                        <input type="hidden" id="box_customer_id" value="customer_'.$c_id.'" name="customer_id"/>
                        <input type="hidden" id="invoice_status" value="'.$invoice_status.'" name="invoice_status"/>


                        <div class="box nav-box g16">
                            <ul class="nav">
                                <li data-nav="#tab1" class="sel">Invoice</li>
                                <li data-nav="#tab2">Payments</li>
                            </ul>
                            <div class="nav-body">
                                <div id="tab1" class="nav-item show">
                                    <div id="t_invoice">

                                        <table class="display table">
                                            <thead>
                                            <tr role="row">
                                                <th rowspan="1" colspan="1">Item</th>
                                                <th rowspan="1" colspan="1">Container</th>
                                                <th rowspan="1" colspan="1">Quantity</th>
                                                <th rowspan="1" colspan="1">Price</th>
                                                <th rowspan="1" colspan="1">Total</th>
                                                <th rowspan="1" colspan="1">Action</th>
                                            </tr>
                                            </thead>

                                            <tbody>';

                                        $sql2="select * from inv_opr  where inv_id='$id' order by id ASC";
                                        $res2=mysql_query($sql2);
                                        $rows2=mysql_num_rows($res2);
                                        if($rows2>0){
                                            while($i<$rows2){
                                                $it_id=mysql_result($res2,$i,'it_id');
                                                $qunt=mysql_result($res2,$i,'qunt');
                                                $ord_id=mysql_result($res2,$i,'ord_id');
                                                $price=mysql_result($res2,$i,'price');

                                                create_invoice_row($it_id,$id,$c_id);

                                                $i++;
                                            }
                                        }
                                        echo '</tbody>
                                        </table>

                                        <div class="g6" id="total_bill"></div>

                                    </div>

                                </div>
                                <div id="tab2" class="nav-item">
                                    <div id="box_customer_name" class="g16">
                                        <input type="text" value="'.$pay.'" name="payment" placeholder="Amount Payment" class="required g5">
                                        <textarea name="payment_note" placeholder="Note Payment" class="required g16">'.$note.'</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <br class="clear">


                        <div class="box btn-box g16 btn_invoice_status" id="toggles">
                         <p class="g3"><label><b>Invoice Status</b></label></p>
                          <button class="invoice_status btn-m green toggle" id="1" onclick="return false">delivered</button>
                          <button class="invoice_status btn-m red toggle" id="2" onclick="return false">not delivered</button>
                          <button class="invoice_status btn-m orange toggle" id="3" onclick="return false">partial delivery</button>
                        </div>

                        <br class="clear">

                        <button type="submit" disabled="" id="'.$id.'" class="save_modified_invoice green btn-m flt-r g3 normal">Save</button>
                        <button type="submit" disabled="" id="'.$id.'" class="save_modified_print blue btn-m flt-r g3 print">Save and Print</button>

                    </form>
                </div>
            </div>';

}?>