<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');

if($_REQUEST['op'] == 'items'){
    if(strtotime(CHECK_LAST_UPDATE('inv_opr')) != strtotime($_SESSION['if_items_up'])
       OR strtotime(CHECK_LAST_UPDATE('ord_opr')) != strtotime($_SESSION['if_orders_up'])){
        echo 'YES';
        $_SESSION['if_orders_up'] = CHECK_LAST_UPDATE('ord_opr');
        $_SESSION['if_items_up'] = CHECK_LAST_UPDATE('inv_opr');
    }else{
        return false;
    }
}

if($_REQUEST['op'] == 'customers'){
    if(strtotime(CHECK_LAST_UPDATE('customers')) != strtotime($_SESSION['if_customers_up'])){
        echo 'YES';
        $_SESSION['if_customers_up'] = CHECK_LAST_UPDATE('customers');
    }else{
        return false;
    }
}
?>