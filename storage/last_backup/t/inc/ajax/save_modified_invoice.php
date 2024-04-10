<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');

if(ceckAjax('l')){

    $user_id=$_SESSION['user_id'];

    $inv_id= $_POST['invoice_id'];

    list($customer_key, $c) = explode("_",$_POST['customer_id']);

    $invoice_status = $_POST['invoice_status'];

    if(!empty($invoice_status)){
        $sql="UPDATE `invices` set `c_id`='$c', `invoice_status` = '$invoice_status' where id='$inv_id' ";
    }else{
        $sql="UPDATE `invices` set `c_id`='$c' where id='$inv_id' ";
    }

    $res=mysql_query($sql);

    //delete old items in this invoice
    $res2=mysql_query("DELETE from `inv_opr` where `inv_id`='$inv_id'");
    $res3=mysql_query("DELETE from `payments` where `inv`='$inv_id'");

    $order_id= $_POST['order_id'];
    $it_id= $_POST['item'];
    $qunt= $_POST['qun'];
    $price= $_POST['price'];

    if($_POST['payment']){
        $pay = $_POST['payment'];
        $note = $_POST['payment_note'];
        mysql_query("INSERT INTO `payments` (`pay`,`cus`,`inv`,`note`,`date`)values('$pay','$customer_id','$inv_id','$note',now())");
    }

    for ($i = 0; $i < count($_POST['item']); $i++) {

        mysql_query("INSERT INTO
        `inv_opr` (`inv_id`,`ord_id`,`it_id`,`qunt`,`price`)
         values
         ('$inv_id','$order_id[$i]','$it_id[$i]','$qunt[$i]','$price[$i]')");

    }

    echo $inv_id;


}
?>
