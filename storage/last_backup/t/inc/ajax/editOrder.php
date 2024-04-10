<?

include('../../min/dbc.php');
include('../../inc/funs.php');

function create_order_row($ord_id , $item_id){

    $id = $ord_id;

    $fileds = array('item', 'qun', 'price', 'total', 'action');

    $html = '<tr id="row_'.$id.'">';

    foreach($fileds as $key){

        $html .= '<td style="padding-top:6px; position: relative;" id="'.$key.'_'.$id.'">';

        if($key == 'item'){

            $item = mysql_result(mysql_query("select name from `items` WHERE `id` = '{$id}' "), 0);

            $html .= "<span>$item</span>";
            $html .= '<input type="hidden" name="'.$key.'[]" value="'.$id.'" >';


        }elseif($key == 'qun'){

            $qun = mysql_result(mysql_query("select qunt from `ord_opr` WHERE `it_id` = '{$item_id}' "), 0);
            $price = mysql_result(mysql_query("select price from `ord_opr` WHERE `it_id` = '{$item_id}' "), 0);

            $html .= '<div style="position: relative; height:50px" ><input style="width: 50px" class="check_order_quantity" value="'.$qun.'" id="'.$id.'_'.$price.'" name="'.$key.'[]" ></div>';

        }elseif($key == 'price'){

            $price = mysql_result(mysql_query("select price from `ord_opr` WHERE `it_id` = '{$item_id}' "), 0);

            $html .= '<div style="position: relative; height:50px" ><input style="width:45px" name="'.$key.'[]" value="'.$price.'" ></div>';

        }elseif($key == 'total'){

            $qun = mysql_result(mysql_query("select qunt from `ord_opr` WHERE `it_id` = '{$item_id}' "), 0);
            $price = mysql_result(mysql_query("select price from `ord_opr` WHERE `it_id` = '{$item_id}' "), 0);

            $html .= $qun*$price;

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

$sql="select * from orders ord  where ord.id='$id' limit 1";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows>0){
    $name=mysql_result($res,$i,'ord.name');
    $id=mysql_result($res,$i,'ord.id');
    $num=mysql_result($res,$i,'ord.num');
    $date=mysql_result($res,$i,'ord.date');
    $expenses=mysql_result($res,$i,'ord.expenses');
    $po=mysql_result($res,$i,'ord.po');
    $shipping_company=mysql_result($res,$i,'ord.shipping_company');
    $shipping_expenses=mysql_result($res,$i,'ord.shipping_expenses');
    $order_status =mysql_result($res,$i,'ord.order_status');
    $supplier_id =mysql_result($res,$i,'ord.supplier');

    $supplier = @mysql_result(mysql_query("SELECT name FROM `suppliers` WHERE `id` = '{$supplier_id}' "),0);

    $result=mysql_query("select * from `suppliers` WHERE `id` != '{$supplier_id}' ORDER BY name ASC");
    $rows=mysql_num_rows($result);
    if($rows>0){
        while($row = mysql_fetch_object($result)){
            if($row->id){
                $html .= '<option value="'.$row->id.'">'.$row->name.'</option>';
            }

        }
    }

    echo '<div id="smp-form" class="box g8 flt-l edit_order_form">
                <p class="box-ttl">Edit Order NO# '.$id.'</p>
                <div class="box-body">

                    <form id="edit-order-form">
                        <input type="hidden" id="order_status" value="'.$order_status.'" name="order_status"/>

                        <div id="box_customer_name" class="g16">
                            <input type="text" name="lot_no" placeholder="LOT#" value="'.$name.'" data-ttip="LOT #" class="required g3 ttip">
                            <input type="text" name="container_no" placeholder="Container number" data-ttip=Container number" value="'.$num.'" class="required g5 ttip">
                            <input type="text" name="expenses" placeholder="Expenses of the container" data-ttip="Expenses of the container" value="'.$expenses.'" class="required g5 ttip">
                            <input type="text" name="po" placeholder="P.O" data-ttip="P.O" value="'.$po.'" class="required g2 ttip">
                        </div>

                        <div id="box_customer_name" class="g16">

                             <select name="supplier" data-ttip="supplier" class="drop select g5 ttip">
                                 <option value="'.$supplier_id.'" selected>'.$supplier.'</option>
                                 '.$html.'
                             </select>

                            <input type="text" name="shipping_company" data-ttip="shipping company" value="'.$shipping_company.'" placeholder="Shipping Company" class="required g5 ttip">
                            <input type="text" name="shipping_expenses" data-ttip="shipping expenses" value="'.$shipping_expenses.'" placeholder="Shipping Expenses" class="required g5 ttip">
                        </div>

                        <hr class="clear">

                        <div id="t_order">

                            <table class="display table">
                                <thead>
                                <tr role="row">
                                    <th rowspan="1" colspan="1">Item</th>
                                    <th rowspan="1" colspan="1">Quantities</th>
                                    <th rowspan="1" colspan="1">Price</th>
                                    <th rowspan="1" colspan="1">Subtotal</th>
                                    <th rowspan="1" colspan="1">Action</th>
                                </tr>
                                </thead>

                                <tbody>';

    $sql2="select * from ord_opr ord , items i , orders o  where ord.ord_id='$id' and ord.it_id=i.id and ord.ord_id=o.id";
    $res2=mysql_query($sql2);
    $rows2=mysql_num_rows($res2);
    if($rows2>0){
        $i=0;
        $total=0;
        while($i<$rows2){
            $v_id=mysql_result($res2,$i,'ord.id');
            $item=mysql_result($res2,$i,'i.name');
            $item_id=mysql_result($res2,$i,'i.id');
            $price=mysql_result($res2,$i,'ord.price');
            $qunt=mysql_result($res2,$i,'ord.qunt');
            $order=mysql_result($res2,$i,'o.name');

            create_order_row($id, $item_id);

            $i++;
        }
    }
    echo '</tbody>
                            </table>

                            <div class="g7" id="total_order_bill"></div>

                        </div>

                        <br class="clear">

                        <div class="box btn-box g16 btn_order_status" id="toggles">
                         <p class="g3"><label><b>Order Status</b></label></p>
                          <button class="order_status btn-m green toggle" id="1" onclick="return false">delivered</button>
                          <button class="order_status btn-m red toggle" id="2" onclick="return false">not delivered</button>
                        </div>

                        <br class="clear">

                        <button type="submit" disabled="" id="'.$id.'" class="save_modified_order green btn-m flt-r g3 normal">Save</button>
                    </form>
                </div>
            </div>';

}?>