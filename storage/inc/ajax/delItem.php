<?
session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');

if(ceckAjax('l')){
    $id=$_POST['opr_id'];

    if(isset($id))
        mysql_query("delete from inv_opr where id='$id' ");

    if(mysql_affected_rows() > 0) echo 1; else echo 0;
}