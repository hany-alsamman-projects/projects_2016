<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
    $user_id=$_SESSION['user_id'];

    //list($customer_key, $customer_id) = explode("_",$_POST['customer_id']);

    $lot_no = $_POST['lot_no'];
    $container_no = $_POST['container_no'];
    $expenses = $_POST['expenses'];
    $po = $_POST['po'];

    $supplier = $_POST['supplier'];
    $shipping_com = $_POST['shipping_company'];
    $shipping_exp = $_POST['shipping_expenses'];


    // add order header to orders table
    $result = mysql_query("
    INSERT INTO `orders`
    (`id`, `name`, `date`, `expenses`, `supplier`, `shipping_company`, `shipping_expenses`, `po`, `user_id`, `num`)
    VALUES
    (NULL, '{$lot_no}', NOW(), '{$expenses}', '{$supplier}', '{$shipping_com}', '{$shipping_exp}', '{$po}', '{$user_id}', '{$container_no}')");

    // get last inserted ID "last invoice added"
    $order_id = mysql_result(mysql_query("select last_insert_id() as l"),0,'l');

    $it_id= $_POST['item'];
    $qunt= $_POST['qun'];
    $price= $_POST['price'];

    for ($i = 0; $i < count($_POST['item']); $i++) {

        mysql_query("INSERT INTO
        `ord_opr`
         (`ord_id`,`it_id`,`qunt`,`price`)
         values
         ('$order_id','$it_id[$i]','$qunt[$i]','$price[$i]')");

    }

    echo $last_order;
}