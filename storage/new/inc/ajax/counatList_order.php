<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');

if(ceckAjax('l')){

	$id=$_POST['id'];

    $fileds = array('item', 'qun', 'price', 'total', 'action');

    $html .= '<tr id="row_'.$id.'">';

    foreach($fileds as $key){

           $html .= '<td style="padding-top:6px" id="'.$key.'_'.$id.'">';

           if($key == 'item'){

               $item = mysql_result(mysql_query("select name from `items` WHERE `id` = '{$id}' "), 0);

               $html .= "<span>$item</span>";
               $html .= '<input type="hidden" name="'.$key.'[]" value="'.$id.'" >';

           }elseif($key == 'qun'){

               // i add price to calculate price*quantity
               $price = mysql_result(mysql_query("select price from `items` WHERE `id` = '{$id}' "), 0);

               $html .= '<input style="width: 50px" class="check_order_quantity" id="'.$id.'_'.$price.'" name="'.$key.'[]" >';

           }elseif($key == 'price'){

               $price = mysql_result(mysql_query("select price from `items` WHERE `id` = '{$id}' "), 0);

               $html .= '<input style="width: 50px" name="'.$key.'[]" value="'.$price.'" >';

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
