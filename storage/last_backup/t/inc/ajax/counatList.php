<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');

if(ceckAjax('l')){

	$id=$_POST['id'];
    $c= ($_POST['c'] == false) ? 0 : $_POST['c'];

    $fileds = array('item', 'dropdown', 'qun', 'price', 'total', 'action');

    $html .= '<tr id="row_'.$id.'">';

    foreach($fileds as $key){

           $html .= '<td style="padding-top:6px; position: relative;" id="'.$key.'_'.$id.'">';

           if($key == 'item'){

               $item = mysql_result(mysql_query("select name from `items` WHERE `id` = '{$id}' "), 0);

               $html .= "<span>$item</span>";
               $html .= '<input type="hidden" name="'.$key.'[]" value="'.$id.'" >';


           }elseif($c == true && $key == 'dropdown'){

               $html .= '<div style="position: relative" ><select style="width:100px; margin-bottom: 20px" id="order_'.$id.'" name="order_id[]" class="drop select">';

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
               $price = mysql_result(mysql_query("select price from `items` WHERE `id` = '{$id}' "), 0);

               $html .= '<div style="position: relative; height:50px" ><input autocomplete="off" style="position: absolute; top:0; width:55px" class="check_quantity required number" value="" id="'.$id.'_'.$price.'" name="'.$key.'[]" ></div>';

           }elseif($key == 'price'){

               $price = mysql_result(mysql_query("select price from `items` WHERE `id` = '{$id}' "), 0);

               $html .= '<div style="position: relative; height:50px" ><input style="width:45px" name="'.$key.'[]" value="'.$price.'" ></div>';

           }elseif($key == 'total'){

               $html .= '0';

           }elseif($key == 'action'){

               $html .= '<a href="#" id="'.$id.'" class="remove_item"><img src="images/delete.png"></a>';

           }

            $html .= '</td>';

    }

    $html .= '</tr>';

    echo $html;

}
?>
