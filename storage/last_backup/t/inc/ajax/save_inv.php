<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');

if(ceckAjax('l')){

    $user_id=$_SESSION['user_id'];

    if( count($_POST['qun']) != count(array_filter($_POST['qun'])) ) return FALSE;


    list($customer_key, $customer_id) = explode("_",$_POST['customer_id']);

    $total_bill = $_POST['total_bill'];

    $invoice_status = $_POST['invoice_status'];

    // add invoice header to invoices table
    $result = mysql_query("INSERT INTO `invices` (`c_id`,`date`,`user_id`, `invoice_status`)values('{$customer_id}',now(),'$user_id','$invoice_status')");

    // get last inserted ID "last invoice added"
    $inv_id = mysql_result(mysql_query("select last_insert_id() as l"),0,'l');

    $order_id= $_POST['order_id'];
    $it_id= $_POST['item'];
    $qunt= $_POST['qun'];
    $price= $_POST['price'];

    for ($i = 0; $i < count($_POST['item']); $i++) {

         mysql_query("INSERT INTO
        `inv_opr` (`inv_id`,`ord_id`,`it_id`,`qunt`,`price`)
         values
         ('$inv_id','$order_id[$i]','$it_id[$i]','$qunt[$i]','$price[$i]')");

    }

    if($_POST['payment']){
        $pay = $_POST['payment'];
        $note = $_POST['payment_note'];
        mysql_query("INSERT INTO `payments` (`pay`,`cus`,`inv`,`note`,`date`)values('$pay','$customer_id','$inv_id','$note',now())");
    }

    echo $inv_id;

}
?>
