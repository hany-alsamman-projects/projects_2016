<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if (ceckAjax('l')) {

    if($_REQUEST['operation'] == 'add_item'){

        mysql_query("INSERT INTO `items` (`name`,`price`) values ('{$_POST['item_title']}','{$_POST['item_price']}')");

    }elseif($_REQUEST['operation'] == 'add_customer'){

        mysql_query("INSERT INTO `customers`
        (`name`,`phone`,`mobile`,`company`,`address`)
        values
        ('{$_POST['contact_name']}','{$_POST['phone']}','{$_POST['mobile']}','{$_POST['company']}','{$_POST['address']}')");

    }elseif($_REQUEST['operation'] == 'add_supplier'){


        mysql_query("INSERT INTO `suppliers`
        (`name`,`phone`,`mobile`,`company`,`address`)
        values
        ('{$_POST['contact_name']}','{$_POST['phone']}','{$_POST['mobile']}','{$_POST['company']}','{$_POST['address']}')");


    }

    if(mysql_affected_rows() > 0) echo 1; else echo 0;

}
?>