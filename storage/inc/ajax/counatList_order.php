<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');

if(ceckAjax('l')){

	$id=$_POST['id'];
    $unique =  rand(0,100000);

    $fileds = array('item', 'qun', 'price', 'total', 'action');

    $html .= '<tr id="row_'.$id.'_'.$unique.'">';

    foreach($fileds as $key){

           $html .= '<td style="padding-top:6px" id="'.$key.'_'.$id.'">';

           if($key == 'item'){

               $item = mysql_result(mysql_query("select name from `items` WHERE `id` = '{$id}' "), 0);

               $html .= "<span>$item</span>";
               $html .= '<input type="hidden" name="'.$key.'[]" value="'.$id.'" >';

           }elseif($key == 'qun'){

               // i add price to calculate price*quantity
               $price = mysql_result(mysql_query("select price from `items` WHERE `id` = '{$id}' "), 0);

               $html .= '<div style="position: relative; height:50px" ><input style="width: 55px" autocomplete="off" class="check_order_quantity validate[required, custom[onlyNumber]]" id="'.$id.'_'.$price.'" name="'.$key.'[]" ></div>';

           }elseif($key == 'price'){

               $price = mysql_result(mysql_query("select price from `items` WHERE `id` = '{$id}' "), 0);

               $html .= '<div style="position: relative; height:50px" ><input id="'.$id.'" autocomplete="off" class="check_order_price_changes validate[required]" style="width: 55px" name="'.$key.'[]" value="" ></div>';

           }elseif($key == 'total'){

               $html .= '0';

           }elseif($key == 'action'){

               $html .= '<a href="#" id="'.$id.'" class="remove_order_item"><img src="images/delete.png"></a>';

           }

            $html .= '</td>';

    }

    $html .= '</tr>';

    echo $html;

}
?>
