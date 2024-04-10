<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');

if(ceckAjax('l')){

    if( $_POST['quantity'] ){
            //$LOT_NO = COUNT_LOT_NO($_POST['item_id']);

            if( preg_match("/^-/", $_POST['lots']) ) $_POST['lots'] = 0;

            if($_POST['quantity'] > $_POST['lots']) {
                echo 0;
            }else{
                echo 1;
            }

    }
}
?>
