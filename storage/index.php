<?
@session_start();
session_name("UI");
include("min/dbc.php");
include("inc/funs.php");
login('l');?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Financial - Dashboard</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
    <link rel="shortcut icon" href="favicon.png">
    <!---CSS Files-->
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/facebox.css">
    <link rel="stylesheet" href="css/validationEngine.css">
    <!---jQuery Files-->
    <script src="library/jquery/jquery.js"></script>
    <script src="library/jquery/jquery-ui.js"></script>

    <script src="library/jquery/validationEngine-en.js"></script>
    <script src="library/jquery/validationEngine.js"></script>

    <script src="library/jquery/inputs.js"></script>
    <script src="library/jquery/flot.js"></script>
    <script src="library/jquery/datatables.js"></script>
    <script src="library/jquery/invoices.js"></script>
    <script src="library/jquery/orders.js"></script>
    <script src="library/jquery/fullscreen-min.js"></script>
    <script src="library/jquery/functions.js"></script>
    <script src="library/jquery/changeBg.js"></script>
    <script src="library/jquery/facebox.js"></script>


</head>
<body>

<div id="wrapper">

    <!--USER PANEL-->

    <div id="usr-panel">
        <div class="av-overlay"></div>
        <img src="images/avatars/nick.jpg" id="usr-av">
        <div id="usr-info">
            <span id="usr-name"><?=$_SESSION['user_name']?></span><span id="usr-role">Administrator</span>
            <button id="usr-btn" class="orange" data-modal="#usr-mod #mod-home">User CP</button>
        </div>
    </div>

    <!--NAVIGATION-->


    <div id="nav">
        <ul>
            <li class="active"><span class="icon">H</span>Dashboard</li>
            <li><a id="add_invoice" href="#"></a><span class="icon">S</span>New Invoice</li>
            <li><a id="add_order" href="#"></a><span class="icon">S</span>New Order</li>
            <li><a id="multi_add" href="#"></a><span class="icon">S</span>Multi Add</li>
            <li><a id="show_invoices" href="#"></a><span class="icon">Y</span>Invoices</li>
            <li><a id="show_orders" href="#"></a><span class="icon">Y</span>Orders</li>
            <li><a onClick="$(document).toggleFullScreen()"></a><span class="icon">J</span>Full screen</li>
            <li data-modal="#usr-mod #mod-set" id="set-btn"><span class="icon">)</span>Settings</li>
            <li id="logout"><a href="login.php?out"></a><span class="icon icon-grad">B</span>Log Out</li>
        </ul>
        <br class="clear">
    </div>

    <div id="content" class="ui-page"><!--BEGIN MAIN CONTENT-->

        <div id="work_area" class="box g16">
            <h2 class="box-ttl">Work Area <span class="box-desc">i can stay with you :)</span><img src="images/close.png" alt="clear area" class="clear_area flt-r"></h2>


            <div class="box-body">


            </div>
        </div>

        <div class="cont full ui-sortable" id="sort-boxes">

            <input type="hidden" id="process_type" value="0">


            <div id="smp-form" class="box g8 invoice_form hidden-desktop">
                <p class="box-ttl">Add New Invoice <img src="images/close.png" alt="" class="close_invoice flt-r"></p>
                <div class="box-body">

                    <form id="new-invoice-form">

                        <div id="box_customer_name"><h2><span>Select Customer</span></h2></div>
                        <hr>

                        <input type="hidden" id="box_customer_id" name="customer_id"/>
                        <input type="hidden" id="invoice_status" value="" name="invoice_status"/>

                        <div class="box nav-box g16">
                            <ul class="nav">
                                <li data-nav="#tab1" class="sel">Invoice</li>
                                <li data-nav="#tab2">Payments</li>
                            </ul>
                            <div class="nav-body">
                                <div id="tab1" class="nav-item show">
                                    <div id="t_invoice">

                                        <table class="display table">
                                            <thead>
                                            <tr role="row">
                                                <th rowspan="1" colspan="1">Item</th>
                                                <th rowspan="1" colspan="1">Container</th>
                                                <th rowspan="1" colspan="1">Quantity</th>
                                                <th rowspan="1" colspan="1">Price</th>
                                                <th rowspan="1" colspan="1">Total</th>
                                                <th rowspan="1" colspan="1">Action</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            </tbody>
                                        </table>

                                        <div class="g6" id="total_bill"></div>

                                    </div>

                                </div>
                                <div id="tab2" class="nav-item">
                                    <div id="box_customer_name" class="g16">
                                        <input type="text" name="payment" placeholder="Amount Payment" class="required g5">
                                        <textarea name="payment_note" placeholder="Note Payment" class="required g16"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <br class="clear">

                        <div class="box btn-box g16 btn_invoice_status" id="toggles">
                            <p class="g3"><label><b>Invoice Status</b></label></p>
                            <button class="invoice_status btn-m green toggle" id="1" onclick="return false">delivered</button>
                            <button class="invoice_status btn-m red toggle" id="2" onclick="return false">not delivered</button>
                            <button class="invoice_status btn-m orange toggle" id="3" onclick="return false">partial delivery</button>
                        </div>

                        <br class="clear">

                        <button type="submit" disabled="" id="save_invoice" class="green btn-m flt-r g3 normal">Save</button>
                        <button type="submit" disabled="" id="save_print" class="blue btn-m flt-r g3 print">Save and Print</button>

                    </form>
                </div>
            </div>

            <div id="smp-form" class="box g8 order_form hidden-desktop">
                <p class="box-ttl">New Order <img src="images/close.png" alt="" class="close_order flt-r"></p>
                <div class="box-body">

                    <form id="new-order-form">

                        <div id="box_customer_name" class="g16">
                            <input type="text" autocomplete="off" name="lot_no" placeholder="LOT#" class="validate[required] g3">
                            <input type="text" autocomplete="off" name="container_no" placeholder="Container number" class="validate[required] g5">
                            <input type="text" autocomplete="off" name="expenses" placeholder="Expenses of the container" class="validate[required , custom[onlyNumber]] g5">
                            <input type="text" autocomplete="off" name="po" placeholder="P.O" class="validate[required] g2">
                        </div>

                        <div id="box_customer_name" class="g16 insert_dd">
                            

                            <input type="text" autocomplete="off" name="shipping_company" placeholder="Shipping Company" class="validate[required] g5">
                            <input type="text"autocomplete="off" name="shipping_expenses" placeholder="Shipping Expenses" class="validate[required , custom[onlyNumber]] g5">
                        </div>

                        <hr class="clear">

                        <div id="t_order">

                            <table class="display table">
                                <thead>
                                <tr role="row">
                                    <th rowspan="1" colspan="1">Item</th>
                                    <th rowspan="1" colspan="1">Quantities</th>
                                    <th rowspan="1" colspan="1">Price</th>
                                    <th rowspan="1" colspan="1">Subtotal</th>
                                    <th rowspan="1" colspan="1">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>

                            <div class="g7 row6" id="total_order_bill"></div>

                        </div>

                        <br class="clear">

                        <button type="submit" disabled="" id="save_order" class="green btn-m flt-r g3 normal">Save</button>

                    </form>
                </div>
            </div>

            <div id="board_list" class="box nav-box g16">
                <ul class="nav">
                    <li class="sel" data-nav="#customers_board">Customers</li>
                    <li data-nav="#items_board">Items</li>

                </ul>
                <div class="nav-body">
                    <div class="nav-item" id="items_board">

                        <br class="clear">

                    </div>
                    <div class="nav-item show" id="customers_board">

                    </div>
                </div>
            </div>

        </div>


        <br class="clear">
        <!--TABLE-->


    </div><!--END MAIN CONTENT-->

    <!--MODAL WINDOWS-->

    <div id="modal-ov">
        <div class="modal" id="usr-mod">
            <div class="mod-ttl"><h2>USER CONTROL PANEL</h2></div>
            <div class="mod-body">
                <div id="mod-home" class="nav-item show">
                    <div class="av-overlay"></div>
                    <img src="images/avatars/nick.jpg">
                    <ul id="usr-det">
                        <li><p><span>Name: </span><?=$_SESSION['user_name']?></p></li>
                        <li><p><span>Role: </span>System Administrator</p></li>
                        <li><p><span>Member since: </span>12.06.2010</p></li>
                    </ul>
                </div>
                <div id="mod-notif" class="nav-item">
                    <div class="notif green no-coll expanded full">
                        Welcome to <?=$_SESSION['user_name']?> !<span class="icon">=</span>
                        <p class="nt-det">Feel free to look around, there is much to see.</p>
                    </div>
                    <div class="notif red full">
                        If a paperclip offers to help, please alert the authorities.
                        <span class="icon">X</span>
                    </div>
                </div>
                <div id="mod-set" class="nav-item">
                </div>
            </div>
            <div class="mod-act">
                <button class="orange close">Close</button>
            </div>
        </div>
    </div>

</div><!--END WRAPPER-->

  <span id="load">
    <img src="images/load.png"><img src="images/spinner.png" id="spinner">
  </span>
<!---jQuery Code-->
<script type='text/javascript'>

    // LOAD FUNCTIONS
    $.fn.loadfns( function() {
        $('#ind-cont #nbill').removeClass('init');
        if ($('#ind-cont').width() < 500) $('#ind-cont').find('.pie-desc').addClass('overlay');
        $(window).resize( function() {
            if ($('body').children('#toast-container').length < 1)
                toastr.info('If content goes out of place when resizing, just hit refresh');
        });
    });

    $('#sort-boxes').sortable({
        handle: ".box-ttl", containment: "#content", revert: 300, tolerance: "pointer",
        placeholder: "box", forcePlaceholderSize: true, cursor: "move"
    });

    $.fn.inputs();

    // FLUID LAYOUT

    var docWidth = $(document).width();
    if (docWidth < 1699 && docWidth > 1499) {
        $('#content')
            .children('#tb-box').removeClass('g7').addClass('g6');
    } else if (docWidth < 1700 && docWidth > 1300) {
        $('#content')
            .children('#stats-cont').removeClass('g2').addClass('g4')
            .siblings('#users-cont').removeClass('g4').addClass('g6')
            .siblings('#chart-box').removeClass('row1').addClass('row2').insertAfter('#recent-conv');
    } else if (docWidth < 1300 && docWidth > 1063) {
        $('#content')
            .children('#stats-cont').removeClass('g2').addClass('g3')
            .siblings('#bk-mng').removeClass('g4').addClass('g7')
            .siblings('#users-cont').removeClass('g4').addClass('g6').insertAfter('#bk-mng')
            .siblings('#chart-box').removeClass('row1').addClass('row2').insertAfter('#users-cont')
            .siblings('#todo-list').removeClass('g5').addClass('g7').insertAfter('#chart-box')
            .siblings('#recent-conv').removeClass('g5').addClass('g9').insertAfter('#chart-box')
            .siblings('#support-tickets').removeClass('g6').addClass('g10').insertAfter('#users-cont')
            .siblings('#tb-box').insertAfter('#ind-cont');
    } else if (docWidth < 1064 && docWidth > 799) {
        $('#content')
            .children('#ind-cont').insertAfter('#cal-box')
            .siblings('#tb-box').insertAfter('#ind-cont')
            .siblings('#chart-box').insertAfter('#users-cont').removeClass('row1').addClass('row2');
    } else if (docWidth < 817 && docWidth > 680) {
        $('#content')
            .children('#bk-mng').insertAfter('#stats-cont');
    } else if (docWidth < 641) {
        $('#content')
            .children('#users-cont').insertAfter('#stats-cont');
    };
    if (docWidth < 1081 && docWidth > 1064) {
        $('#content')
            .children('#chart-box').removeClass('row2').addClass('row1').insertAfter('#users-cont')
    };

</script>
</body>
</html>
