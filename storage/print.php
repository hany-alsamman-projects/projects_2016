<?
session_start();
include("min/dbc.php");
include("inc/funs.php");
login('l');
$id=$_GET['v'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="library/invoice/invoice.css" type="text/css" charset="utf-8" />
    <script type="text/javascript" src="library/jquery/jquery.js"></script>
    <script type="text/javascript" src="library/invoice/jquery.tablesorter.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
            {
                $("#table").tablesorter({
                    widgets: ['zebra']
                });
            }
        );
    </script>

    <title>PRINT INVOICE NO# <?=$id?></title>

</head>

<body>

<div id="page">



    <?php
    $sql="select * from invices i , customers c where i.id='$id' and i.c_id=c.id limit 1 ";
    $res=mysql_query($sql);
    $rows=mysql_num_rows($res);

    $company=mysql_result($res,0,'c.company');
    $date=mysql_result($res,0,'i.date');

    $sql2="select v.ord_id , sum(v.qunt) as q ,avg(v.price) as p,i.name
	from inv_opr v , items i
	where v.inv_id='$id' and v.it_id=i.id
	group by i.name ";
    $res2=mysql_query($sql2);
    $rows2=mysql_num_rows($res2);

    ?>
    <p class="recipient-address">
       <small> <?=get_val('inv_text','header',1)?></small>
    </p>

    <h1>Invoice NO# <?=$id?></h1>
    <p class="terms"><strong>Customer</strong><br/>
        <?=$company?><br>
	Phone: <?=mysql_result($res,0,'c.phone')?> <br>
	Mobile: <?=mysql_result($res,0,'c.mobile')?> <br>
	Address: <?=mysql_result($res,0,'c.address')?> <br>
	</p>

    <img src="library/invoice/images/logo.jpg" alt="" class="company-logo" />



    <table id="table" class="tablesorter" cellspacing="0">
        <thead>
        <tr>
            <th>#LOT</th>
            <th>Item</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>

        <?
        $i=0;
        $total=0;
        while($i<$rows2){
            $item=mysql_result($res2,$i,'i.name');
            $price=mysql_result($res2,$i,'p');
            $qunt=mysql_result($res2,$i,'q');
            $tot=$price*$qunt;
            $total=$total+$tot;

            //added by hany
            $lotid = mysql_result(mysql_query("SELECT name FROM `orders` WHERE `id` = '".mysql_result($res2,$i, 'v.ord_id')."' "),0);


            ?><tr bgcolor="<?=$col?>">

            <td align="center"><?=$lotid?></td>
            <td align="center"><?=$item?></td>
            <td align="center"><?=Price($price)?></td>
            <td align="center"><?=$qunt?></td>
            <td width="90" align="center"><?=Price($tot)?></td>
            </tr><?
            $i++;
        }
        ?>

        </tbody>
    </table>

    <div class="total-due">
        <div class="total-heading"><p>Amount Due</p></div>
        <div class="total-amount"><p><?=Price($total)?></p></div>
    </div>

    <hr />

	<?
	    $get_payment = @mysql_query("SELECT * FROM `payments` WHERE `inv` = '{$id}' limit 1");

	    $pay = @mysql_result($get_payment,0,'pay');
    	    $note = @mysql_result($get_payment,0,'note');
	?>

    <div class="pay-buttons">
        <div style="width:100%; margin-bottom:15px;">



        <strong><?=$company?></strong><br /><br /><br />


        SIGNATURE:<span style="color:#ccc">_____________________________</span></div>
        <div style="font-size:14px; margin-bottom:10px"><?=nl2br(get_val('inv_text','footer',1))?></div>
        <div style="font-size:13px">invoice Date : <?=$date?></div>
        <div style="font-size:13px">&nbsp; Print  Date  : <?=date('Y-m-d h:i:s')?></div></div>

        <div style="font-size:13px; text-align:left; width:100%">Payment : <?=$pay?></div>
        <div style="font-size:13px; text-align:left; width:100%">Note  Payment  : <?=$note?></div></div>


</div>

</div>
<div class="page-shadow"></div>


</body>
</html>
