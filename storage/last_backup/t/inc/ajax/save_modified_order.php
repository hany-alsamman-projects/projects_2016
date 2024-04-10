<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');

if(ceckAjax('l')){

    $user_id=$_SESSION['user_id'];

    $opr_id=$_POST['opr_id'];

    $lot_no = $_POST['lot_no'];
    $container_no = $_POST['container_no'];
    $expenses = $_POST['expenses'];
    $po = $_POST['po'];

    $supplier = $_POST['supplier'];
    $shipping_com = $_POST['shipping_company'];
    $shipping_exp = $_POST['shipping_expenses'];

    $order_status = $_POST['order_status'];

    if(!empty($order_status)){
        $sql2="Update `orders`
        set
        `name`='{$lot_no}',
        `date`= NOW(),
        `num`='{$container_no}',
        `expenses`= '{$expenses}' ,
        `supplier`= '{$supplier}' ,
        `shipping_company`='{$shipping_com}',
        `shipping_expenses`='{$shipping_exp}',
        `po`='{$po}',
        `user_id`='{$user_id}',
        `order_status` = '$order_status'
        where id='$opr_id'";

    }else{
        $sql2="Update `orders`
        set
        `name`='$lot_no',
        `date`= NOW(),
        `num`='{$container_no}',
        `expenses`= '{$expenses}' ,
        `supplier`= '{$supplier}' ,
        `shipping_company`='{$shipping_com}',
        `shipping_expenses`='{$shipping_exp}',
        `po`='{$po}',
        `user_id`='{$user_id}'
        where id='$opr_id'";

    }

    mysql_query($sql2);

    //delete old orders
    mysql_query("delete from `ord_opr` where ord_id='$opr_id'");

    $it_id= $_POST['item'];
    $qunt= $_POST['qun'];
    $price= $_POST['price'];

    for ($i = 0; $i < count($_POST['item']); $i++) {

        mysql_query("INSERT INTO
        `ord_opr` (`ord_id`,`it_id`,`qunt`,`price`)
         values
         ('$opr_id','$it_id[$i]','$qunt[$i]','$price[$i]')");

    }

    echo $opr_id;


}
?>